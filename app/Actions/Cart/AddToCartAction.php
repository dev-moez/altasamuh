<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddToCartAction
{
    public function __construct(
        public readonly string $cartableType,
        public readonly int $cartableId,
        public readonly int $amount,
        public readonly ?string $phoneNumber = null,
        public readonly ?string $countryCode = null
    ) {}

    public function execute()
    {
        $cart = $this->getCart();

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

    private function getCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            if (!session()->has('altasamuh_cart_session')) {
                session()->put('altasamuh_cart_session', uniqid('altasamuh_cart_', true));
            }
            return Cart::firstOrCreate(['session_id' => Session::get('altasamuh_cart_session')]);
        }
    }
}
