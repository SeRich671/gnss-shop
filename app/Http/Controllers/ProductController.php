<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function addToCart(AddToCartRequest $request, Product $product): RedirectResponse
    {
        Cart::addToCart($product, $request->has('quantity') ? $request->input('quantity') : 1);

        return redirect()->back()->with('cart_success', 'Product added to cart successfully');
    }

    public function clearCart(): RedirectResponse
    {
        Cart::emptyCart();

        return redirect()->back()->with('cart_success', 'Cart was cleared');
    }

    public function updateCart(Request $request, Product $product): RedirectResponse
    {
        Cart::changeQuantity($product, $request->has('quantity') ? $request->input('quantity') : 1);

        return redirect()->back()->with('cart_success', 'Product quantity was updated');
    }

    public function removeFromCart(Product $product): RedirectResponse
    {
        Cart::removeFromCart($product);

        return redirect()->back()->with('cart_success', 'Product was removed from cart');
    }
}
