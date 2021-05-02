<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryApiController extends Controller
{
    public function index()
    {
    	$get_category = Category::where('status',1)->get();
    	 return response()->json($get_category, 200);
    }
}
