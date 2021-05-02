<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;

class QuestionApiController extends Controller
{
    public function index($category_id)
    {
    	$get_question = Question::where('category_id',$category_id)->where('status',1)->select('id','category_id','question')->get();
    	
    	return response()->json($get_question, 200);
    }
   
}
