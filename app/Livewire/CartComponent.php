<?php

namespace App\Livewire;

use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\CheckoutAction;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{

    public $cartItems;

    public function mount()
    {
        $this->cartItems = CartItem::whereHas('cart', fn($query) => $query->where([
            'checked_out' => false
        ])->where(['user_id' => auth()->id()])
            ->orWhere('session_id', session()->get('altasamuh_cart_session_id')))
            ->get();
    }
    public function render()
    {
        return view('livewire.cart-component');
    }

    #[On('addToCart')]
    public function addToCart(
        string $cartableType,
        int  $cartableId,
        float $amount,
        ?string $phoneNumber = null
    ) {
        (new AddToCartAction($cartableType, $cartableId, $amount, $phoneNumber))->execute();

        $this->dispatch('refreshCart');
        $this->dispatch('success-message', ['message' => 'تم اضافة المشروع للسلة بنجاح']);
    }

    public function checkout()
    {
        (new CheckoutAction())->execute();
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
            Cart::where('session_id', session()->get('altasamuh_cart_session_id'))->delete();
        $this->dispatch('refreshCart');
    }

    #[On('refreshCart')]
    public function refreshCart()
    {
        $this->cartItems = CartItem::whereHas('cart', fn($query) => $query->where('user_id', auth()->id()))->get();
    }
}
