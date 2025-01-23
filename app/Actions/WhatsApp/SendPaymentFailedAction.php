<?php

namespace App\Actions\WhatsApp;

use Illuminate\Support\Facades\Http;

class SendPaymentFailedAction
{
    public function __construct(public readonly string $recipient) {}

    public function execute(string $amount, string $projectName, string $date): void
    {
        Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
            ->post(
                "https://graph.facebook.com/v21.0/" . env('WHATSAPP_PHONE_NUMBER_ID') . "/messages",
                [
                    "messaging_product" => "whatsapp",
                    "to" => $this->recipient,
                    "type" => "template",
                    "template" => [
                        "name" => "payment_failed_01",
                        "language" => [
                            "code" => "ar",
                            "policy" => "deterministic"
                        ],
                        "components" => [
                            [
                                "type" => "body",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $amount . " د. ك"
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => $projectName
                                    ],
                                    [
                                        "type" => "text",
                                        "text" => $date
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            );
    }
}
