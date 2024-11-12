<?php

namespace App\Actions\Registration;

use App\Models\PhoneNumberVerification;
use App\Models\User;
use App\Actions\WhatsApp\SendWhatsAppMessageAction;


class SendOTPVerificationAction
{
    public function __construct(private User $user) {}
    public function execute()
    {
        $otp = mt_rand(100000, 999999);
        PhoneNumberVerification::create([
            'user_id' => $this->user->id,
            'phone_number' => $this->user->fullPhoneNumber(),
            'otp' => random_int(100000, 999999),
        ]);
        (new SendWhatsAppMessageAction($this->user->fullPhoneNumber()))->execute($otp);
    }
}
