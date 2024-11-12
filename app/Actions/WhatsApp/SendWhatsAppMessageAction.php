<?php

namespace App\Actions\WhatsApp;

use Illuminate\Support\Facades\Http;

class SendWhatsAppMessageAction
{
    public function __construct(public readonly string $recipient) {}

    public function execute(string $otp): void
    {
        $response = Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
            ->post(
                "https://graph.facebook.com/v21.0/" . env('WHATSAPP_PHONE_NUMBER_ID') . "/messages",
                [
                    "messaging_product" => "whatsapp",
                    "to" => $this->recipient,
                    "type" => "template",
                    "template" => [
                        "name" => "verify_code_003",
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
                                        "text" => $otp
                                    ]
                                ]
                            ],
                            [
                                "type" => "button",
                                "sub_type" => "url",
                                "index" => "0",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $otp
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            );


        // dd($response->body());
        // if ($response->successful()) {
        //     return "Successful";
        // } else {
        //     dd($response->body());
        //     return "False";
        // }
    }
}

/*

[
                "messaging_product" => "whatsapp",
                "to" => $this->recipient,
                "type" => "template",
                "template" => [
                    "name" => "marketing001",
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
                                    "text" => $message
                                ]
                            ]
                        ]
                    ]
                ]
            ]
                */
