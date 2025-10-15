<?php

namespace App\Http\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Psr\Http\Message\ServerRequestInterface;

class PaytabsService
{
    protected $profileId;
    protected $serverKey;
    protected $clientKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->profileId = config('services.paytabs.profile_id') ?? env('PAYTABS_PROFILE_ID');
        $this->serverKey = config('services.paytabs.server_key') ?? env('PAYTABS_SERVER_KEY');
        $this->clientKey  = config('services.paytabs.client_key') ?? env('PAYTABS_CLIENT_KEY');
        $this->baseUrl = rtrim(config('services.paytabs.base_url') ?? env('PAYTABS_BASE_URL', 'https://api.paytabs.com'), '/');
    }

    /**
     * Create a merchant reference string
     */
    public function generateMerchantReference($prefix = 'APP')
    {
        return strtoupper($prefix . '_' . Str::random(8) . '_' . time());
    }

    /**
     * Create hosted payment page (returns array with payment_page_url and full response)
     * This uses PayTabs' "create pay page / payment page" API — exact endpoint may differ per account/version.
     */
    public function createPaymentPage(array $payload): array
    {
        // set auth header
        $url = $this->baseUrl . '/payment/invoice/new'; // keep configurable; adjust per PayTabs docs if necessary

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->serverKey,
        ];

        // example: using Laravel HTTP client
        $response = Http::withHeaders($headers)
            ->timeout(30)
            ->post($url, $payload);

        if ($response->failed()) {
            return [
                'success' => false,
                'status' => $response->status(),
                'body' => $response->body(),
            ];
        }

        return [
            'success' => true,
            'status' => $response->status(),
            'body' => $response->json(),
        ];
    }
}
