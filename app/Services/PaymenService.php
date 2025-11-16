<?php

namespace App\Services;

use YooKassa\Client;
use YooKassa\Model\Payment;

class PaymentService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuth(config('services.yookassa.account_id'), config('services.yookassa.secret_key'));
    }

    public function createPayment(int $ticketId, float $amount): array
    {
        $response = $this->client->createPayment([
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => config('app.url') . '/telegram',
            ],
            'capture' => true,
            'description' => "Ticket #{$ticketId}",
        ]);

        return $response->jsonSerialize();
    }
}
