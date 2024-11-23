<?php

namespace App\Livewire;

use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\CheckoutAction;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartComponent extends Component
{
    public $cartItems;
    public $paymentMethodId;

    public function mount()
    {
        // $this->cartItems = CartItem::with('cartable')->whereHas('cart', function ($query) {
        //     $query
        //         ->where(function ($query) {
        //             $query->where('user_id', auth()->id())
        //                 ->orWhere('session_id', Session::getId());
        //         });
        // })->get();
        $this->refreshCart();
    }
    public function render()
    {
        return view('livewire.cart-component');
    }

    #[On('addToCart')]
    public function addToCart(
        string $cartableType,
        int $cartableId,
        float $amount,
        ?string $phoneNumber = null
    ) {
        (new AddToCartAction($cartableType, $cartableId, $amount, $phoneNumber))->execute();

        $this->dispatch('refreshCart');
        $this->dispatch('success-message', ['message' => 'تم اضافة المشروع للسلة بنجاح']);
    }

    public function checkout()
    {
        $this->validate([
            'paymentMethodId' => 'required',
        ], [
            'paymentMethodId.required' => 'يرجى اختيار طريقة الدفع',
        ]);

        (new CheckoutAction($this->paymentMethodId))->execute();
    }

    public function removeFromCart($itemId)
    {
        CartItem::find($itemId)->delete();
        $this->dispatch('refreshCart');
    }

    public function clearCart()
    {
        if (auth()->check())
            Cart::where('user_id', auth()->id())->delete();
        else
            Cart::where('session_id', Session::getId())->delete();
        $this->dispatch('refreshCart');
    }


    #[On('refreshCart')]
    public function refreshCart()
    {
        $sessionId = Session::getId();
        $this->cartItems = CartItem::whereHas('cart', function ($query) use ($sessionId) {
            $query->where(function ($query) use ($sessionId) {
                $query->where('user_id', auth()->id())
                    ->orWhere('session_id', $sessionId);
            });
        })->get();
    }
}
