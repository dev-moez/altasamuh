<?php

namespace App\Actions\WhatsApp;

use Illuminate\Support\Facades\Http;

class SendWhatsAppMessageAction
{
    public function __construct(public readonly string $recipient) {}

    public function execute(string $message): string
    {
        $response = Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
            ->post("https://graph.facebook.com/v18.0/" . env('WHATSAPP_PHONE_NUMBER_ID') . "/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $this->recipient,
                'type' => 'text',
                'text' => [
                    'body' => $message
                ]
            ]);

        dd($response);
        if ($response->successful()) {
            return "Successful";
        } else {
            return "False";
        }
    }
}
