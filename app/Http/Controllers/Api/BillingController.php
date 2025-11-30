<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleXMLElement;

class BillingController extends Controller
{
    public function billingHistory(Request $request){
        try {
            $user = $request->user();
            $billings = Invoice::where('patient_id', $user->id)->where('paymentstatus', 'paid')->orderByDesc('created_at')
            ->with(['hospital', 'doctor', 'offer'])->get();
            return $this->SuccessResponse(200, 'Billing history retrieved successfully', $billings);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function billingDetails(Request $request, $id){
        try {
            $user = $request->user();
            $invoice = Invoice::where('patient_id', $user->id)->where('paymentstatus', 'paid')->where('id', $id)->first();

            if (!$invoice) {
                return $this->ErrorResponse(404, 'Billing record not found');
            }

            $vat_amount = ($invoice->subtotal * $invoice->vat) / 100;
            $total = $invoice->subtotal + $vat_amount;

            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            // $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            $data = [
                'invoice_number' => $invoice->invoice_number,
                'doctor_id' => $invoice->doctor_id ? (int)$invoice->doctor_id : $invoice->doctor_id,
                'offer_id' => $invoice->offer_id ? (int)$invoice->offer_id : $invoice->offer_id,
                'customer_name' => $invoice->patient?->name,
                'customer_id_number' => $invoice->patient?->id_number,
                'company_name' => $invoice->company_name,
                'company_address' => $invoice->company_address,
                'invoice_date' => $invoice->invoice_date,
                'tax_number' => $invoice->tax_number,
                'subtotal' => $invoice->subtotal,
                'vat' => $invoice->vat,
                'vat_amount' => $vat_amount,
                'total' => $total,
                'qrCode' => $qrData
            ];
            return $this->SuccessResponse(200, 'Billing details retrieved successfully', $data);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }


    protected function generateZatcaQr($invoice, $vat_amount, $total)
    {
        // 1️⃣ Generate XML
        $xmlString = $this->generateInvoiceXml($invoice);
        // 2️⃣ Hash
        $rawHash = hash('sha256', $xmlString, true);
        $hashBase64 = base64_encode($rawHash);
        // 3️⃣ Sign with Private Key
        $privateKey = openssl_pkey_get_private(file_get_contents(storage_path('app/private_key.pem')));
        $signature = '';
        openssl_sign($rawHash, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        $signature = base64_encode($signature);
        // 4️⃣ Public Key (convert to DER)
        $publicKeyPem = file_get_contents(storage_path('app/public_key.pem'));
        $publicKeyDer = $this->pemToDer($publicKeyPem);
        // 5️⃣ Certificate (convert to DER)
        $certPem = file_get_contents(storage_path('app/zatca_cert.pem'));
        $certDer = $this->pemToDer($certPem);
        // 6️⃣ TLV Encoding
        $tlvData  = $this->toTLV(1, $invoice->company_name);
        $tlvData .= $this->toTLV(2, $invoice->tax_number);
        $tlvData .= $this->toTLV(3, $invoice->invoice_date->format('Y-m-d\TH:i:sp'));
        $tlvData .= $this->toTLV(4, (string)number_format($total, 2, '.', ''));
        $tlvData .= $this->toTLV(5, (string)number_format($vat_amount, 2, '.', ''));
        // Ensure hash is base64 and valid for ZATCA
        $tlvData .= $this->toTLV(6, rtrim(strtr($hashBase64, '+/', '-_'), '='));
        $tlvData .= $this->toTLV(7, $signature);
        return base64_encode($tlvData);
    }

    private function generateInvoiceXml($invoice){
        $uuid = Str::uuid()->toString();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
        <Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
                xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
                xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
                xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
        </Invoice>');

        // UBLExtensions (mandatory for signing)
        $ext = $xml->addChild('ext:UBLExtensions', null, 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
        $ext->addChild('ext:UBLExtension', '', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');

        // Mandatory Fields
        $xml->addChild('cbc:ProfileID', 'reporting:1.0', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:ID', $invoice->id, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:UUID', $uuid, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:IssueDate', $invoice->invoice_date->format('Y-m-d'), 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:IssueTime', $invoice->invoice_date->format('H:i:sP'), 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:InvoiceTypeCode', '388', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->addChild('cbc:DocumentCurrencyCode', 'SAR', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');

        // Example total
        $legalMonetaryTotal = $xml->addChild('cac:LegalMonetaryTotal', '', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
        $legalMonetaryTotal->addChild('cbc:PayableAmount', $invoice->total_amount, 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2')
            ->addAttribute('currencyID', 'SAR');

        return  $xml->asXML();
    }

    private function pemToDer($pem){
        $data = preg_replace('/-----.*-----/', '', $pem);
        $data = str_replace(["\r", "\n"], '', $data);
        return base64_decode($data);
    }

    private function toTLV($tag, $value){
        $len = strlen($value);

        // Handle variable length encoding (ZATCA spec)
        if ($len < 128) {
            $lengthBytes = chr($len);
        } elseif ($len < 256) {
            $lengthBytes = chr(0x81) . chr($len);
        } else {
            $lengthBytes = chr(0x82) . chr($len >> 8) . chr($len & 0xFF);
        }

        return chr($tag) . $lengthBytes . $value;
    }

}
