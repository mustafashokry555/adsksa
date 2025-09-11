<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billingHistory(Request $request){
        try {
            $user = $request->user();
            $billings = Invoice::where('patient_id', $user->id)->orderByDesc('created_at')
            ->with(['hospital', 'doctor'])->get();
            return $this->SuccessResponse(200, 'Billing history retrieved successfully', $billings);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }

    public function billingDetails(Request $request, $id){
        try {
            $user = $request->user();
            $billing = $user->billings()->where('id', $id)->first();
            if (!$billing) {
                return $this->ErrorResponse(404, 'Billing record not found');
            }
            return $this->SuccessResponse(200, 'Billing details retrieved successfully', $billing);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
/*
    public function invoice_download(Invoice $invoice)
    {
        $vat_amount = ($invoice->subtotal * $invoice->vat) / 100;
        $total = $invoice->subtotal + $vat_amount;
        if (Auth::user()->is_doctor() && Auth::user()->id == $invoice->doctor_id) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            return view('admin.invoice.download', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } elseif (Auth::user()->is_hospital() && Auth::user()->hospital_id == $invoice->hospital_id) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            return view('admin.invoice.download', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } elseif (Auth::user()->is_admin()) {
            // بيانات ZATCA QR
            $qrData = $this->generateZatcaQr($invoice, $vat_amount, $total);
            $qrCode = QrCode::encoding('UTF-8')->errorCorrection('L')->size(200)->generate($qrData);

            return view('admin.invoice.download', [
                'invoice' => $invoice,
                'qrCode' => $qrCode
            ]);
        } else {
            abort(401);
        }
    }

    private function pemToDer($pem)
    {
        $data = preg_replace('/-----.*-----/', '', $pem);
        $data = str_replace(["\r", "\n"], '', $data);
        return base64_decode($data);
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
    private function toTLV($tag, $value)
    {
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


    private function generateInvoiceXml($invoice)
    {
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
    }*/
}
