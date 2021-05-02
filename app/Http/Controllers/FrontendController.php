<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
	// Create FrontPage method & page For User
    public function index()
    {
    	return view('frontend.index');
    }
    // Create CartPage method & page For User
    public function cartpage()
    {
    	return view('frontend.cart');
    }
    // Create Checkout method & page For User
    public function frontcheckout()
    {
    	return view('frontend.checkout');
    }
}
