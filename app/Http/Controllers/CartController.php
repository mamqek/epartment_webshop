<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        $user = auth()->user();
        Log::info(Auth::check());
        Log::info($user);
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }

        $cart->load('cartItems.sku.item');

        if ($cart->cartItems->isNotEmpty()) {
            $total = $cart->cartItems->sum(function ($cartItem) {
                return ($cartItem->sku->price_your + ($cartItem->extra_option ? $cartItem->sku->item->extra_option : 0)) * $cartItem->quantity;
            });
            $cart->total = $total;
            $cart->save();
        }

        return $cart;
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }

        $item_sku = $request->input('sku_id');
        $extra_option = $request->input('extra_option');

        $cart_item = CartItem::where('cart_id', $cart->id)->where('sku_id', $item_sku)->where('extra_option', $extra_option)->first();

        if ($cart_item) {
            $cart_item->quantity += 1;
            $cart_item->save();
            return;
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'sku_id' => $item_sku,
            'quantity' => 1,
            'extra_option' => $extra_option,
        ]);

        return; 
    }

    public function destroy(CartItem $cart)
    {
        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
            return $cart;
        }
        $cart->delete();
        return;
    }
}
