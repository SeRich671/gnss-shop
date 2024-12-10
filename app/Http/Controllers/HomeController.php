<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function welcome()
    {
        $products = Product::query()
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('welcome', compact('products'));
    }
}
