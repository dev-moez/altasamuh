<?php

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
            'phone_number' => $this->user->phone_number,
            'otp' => random_int(100000, 999999),
        ]);
        $message = "Your OTP is: $otp .Please enter it in the app";
        (new SendWhatsAppMessageAction($this->user->phone_number))->execute($message);
    }
}
