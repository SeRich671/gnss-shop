<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $orders = auth()->user()->orders;

        return view('dashboard', compact('orders'));
    }
}
