<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCsr extends Command
{
    protected $signature = 'csr:generate';
    protected $description = 'Generate CSR and keys for ZATCA integration';

    public function handle()
    {
        $dn = [
            "countryName"            => "SA",
            "stateOrProvinceName"    => "Riyadh",
            "localityName"           => "Riyadh",
            "organizationName"       => "My Company Name",
            "organizationalUnitName" => "IT Department",
            "commonName"             => "mycompany.com",
            "emailAddress"           => "info@mycompany.com"
        ];

        $privkeyConfig = [
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ];

        $privkey = openssl_pkey_new($privkeyConfig);

        if ($privkey === false) {
            $this->error("❌ Failed to generate private key. Check OpenSSL config.");
            return;
        }

        $csr = openssl_csr_new($dn, $privkey, ['digest_alg' => 'sha256']);
        if ($csr === false) {
            $this->error("❌ Failed to generate CSR.");
            return;
        }

        openssl_pkey_export($privkey, $privateKeyPem);
        $keyDetails = openssl_pkey_get_details($privkey);
        $publicKeyPem = $keyDetails['key'];
        openssl_csr_export($csr, $csrPem);

        // احفظ الملفات جوه storage
        file_put_contents(storage_path("app/private_key.pem"), $privateKeyPem);
        file_put_contents(storage_path("app/public_key.pem"), $publicKeyPem);
        file_put_contents(storage_path("app/certificate_request.csr"), $csrPem);

        $this->info("✅ CSR & Keys generated in storage/app/");
    }
}
