<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    private const SESSION_CART_KEY = 'cart';

    static public function addToCart(Product $product, int $quantity): Collection
    {
        $cart = Session::get(self::SESSION_CART_KEY);

        if (!$cart) {
            $cart = [];
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        Session::put(self::SESSION_CART_KEY, $cart);

        return self::retrieveCart();
    }

    public static function retrieveCart(): Collection
    {
        $cart = Session::get(self::SESSION_CART_KEY);

        return collect($cart)->map(function ($item, $key) {
            return [
                'product' => Product::find($key),
                'quantity' => $item,
            ];
        });
    }

    static public function changeQuantity(Product $product, int $quantity): Collection
    {
        $cart = Session::get(self::SESSION_CART_KEY);

        if (isset($cart[$product->id])) {
            $cart[$product->id] = $quantity;
        }

        Session::put(self::SESSION_CART_KEY, $cart);

        return self::retrieveCart();
    }

    static public function removeFromCart(Product $product): Collection
    {
        $cart = Session::get(self::SESSION_CART_KEY);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
        }

        Session::put(self::SESSION_CART_KEY, $cart);

        return self::retrieveCart();
    }

    static public function emptyCart(): Collection
    {
        Session::put(self::SESSION_CART_KEY, []);

        return self::retrieveCart();
    }

    static public function cartItemCount(): int
    {
        return self::retrieveCart()->count();
    }

    static public function toOrderProductArray(): array
    {
        return self::retrieveCart()->map(function ($item) {
            return [
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity']
            ];
        })->toArray();
    }

    static public function calculateTotalPrice() {
        $total = 0;

        foreach (self::retrieveCart() as $item) {
            $total += $item['product']->price * $item['quantity'];
        }

        return round($total, 2);
    }
}
