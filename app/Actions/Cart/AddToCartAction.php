<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

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
            return Cart::firstOrCreate(['user_id' => Auth::id(), 'checked_out' => false]);
        } else {
            if (!Cookie::has('altasamuh_cart_cookie')) {
                $cookieId = Str::uuid();
                Cookie::queue('altasamuh_cart_cookie', $cookieId, 2628000); // Expires in 1 month
            }
            return Cart::firstOrCreate(['session_id' => Cookie::get('altasamuh_cart_cookie'), 'checked_out' => false]);
        }
    }
}
