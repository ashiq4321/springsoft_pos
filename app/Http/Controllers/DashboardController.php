<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function frontcart()
    {
    	return view('frontend.cart');
    }

    // Create Checkout Method with Checkout Page
    public function frontcheckout()
    {
        return view('frontend.checkout');
    }
}
