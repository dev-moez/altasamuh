<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AddToCartAction
{
    public function __construct(public readonly string $cartableType, public readonly int $cartableId, public readonly int $amount, public readonly ?string $phoneNumber = null, public readonly ?string $countryCode = null) {}

    public function execute()
    {
        if (auth()->guest()) {
            // Start the session if it hasn't already been started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Ensure a unique session ID
            if (!Session::has('altasamuh_cart_session_id')) {
                session_regenerate_id(true); // Generate a new session ID
                Session::put('altasamuh_cart_session_id', session_id());
            }
            $cart = Cart::firstOrCreate(['checked_out' => false, 'session_id' => Session::get('altasamuh_cart_session_id')]);
        } else {
            $cart = auth()->user()->carts()->firstOrCreate(['checked_out' => false]);
        }
        $cart->update([
            'phone_number' => $this->phoneNumber,
            'country_code' => $this->countryCode
        ]);
        $cartItem = $cart->items()->where([
            'cartable_type' => $this->cartableType,
            'cartable_id' => $this->cartableId
        ])->first();
        if ($cartItem) {
            $cartItem->amount += $this->amount;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'cartable_type' => $this->cartableType,
                'cartable_id' => $this->cartableId,
                'amount' => $this->amount,
            ]);
        }
    }

    public function getCartSessionId()
    {
        return Session::get('altasamuh_cart_session_id');
    }
}
