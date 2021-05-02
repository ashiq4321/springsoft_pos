<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;


class QuestionViewController extends Controller
{
    public function view_answer()
    {
    	$get_answers = Answer::orderBy('id','desc')->get();
    	return view('admin.question.view',compact('get_answers'));
    }
}
