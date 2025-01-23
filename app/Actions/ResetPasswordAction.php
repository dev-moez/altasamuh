<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ResetPasswordAction
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $phoneNumber,
        public ?string $token = null,
        public ?string $recipient = null,
    ) {
        $this->recipient = $countryCode . $phoneNumber;
    }

    public function execute(): void
    {
        $this->createPasswordResetToken();
        $this->sendPasswordResetLink();
    }

    private function createPasswordResetToken()
    {
        $this->token = Str::random(60);
        DB::table("password_reset_tokens")->where('phone_number', $this->phoneNumber)->delete();
        DB::table('password_reset_tokens')->insert([
            'phone_number' => $this->phoneNumber,
            'token' => $this->token,
            'created_at' => now()
        ]);
    }

    private function sendPasswordResetLink()
    {
        Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
            ->post(
                "https://graph.facebook.com/v21.0/" . env('WHATSAPP_PHONE_NUMBER_ID') . "/messages",
                [
                    "messaging_product" => "whatsapp",
                    "to" => $this->recipient,
                    "type" => "template",
                    "template" => [
                        "name" => "resspass001",
                        "language" => [
                            "code" => "ar",
                            "policy" => "deterministic"
                        ],
                        "components" => [
                            [
                                "type" => "button",
                                "sub_type" => "url",
                                "index" => "0",
                                "parameters" => [
                                    [
                                        "type" => "text",
                                        "text" => $this->token
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            );
    }
}
