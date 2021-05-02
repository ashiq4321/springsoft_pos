<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserApiController extends Controller
{
    public function index($user_id)
    {
    	$get_user = User::where('id',$user_id)->select('id','name','email')->get();
    	return response()->json($get_user, 200);
    }
}
