<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;
use App\Support\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if(Cart::cartItemCount() > 0) {
            return view('order.index', [
                'user' => auth()->user(),
                'products' => Cart::retrieveCart()
            ]);
        }else{
            return redirect()->route('home');
        }

    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $userInfo = $request->validated();
        $userInfo['price'] = Cart::calculateTotalPrice();

        if(auth()->user()) {
            $userInfo['user_id'] = auth()->id();
        }

        $address = $request->validated('address');

        DB::beginTransaction();
        $order = Order::create($userInfo);
        $order->address()->create($address);

        $order->products()->sync(Cart::toOrderProductArray());

        DB::commit();

        Cart::emptyCart();

        return redirect()->route('dashboard')->with('success', 'Order was successfully created');
    }
}
