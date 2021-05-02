<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Auth;
use Carbon\Carbon;


class AnswerController extends Controller
{
    public function answerpost(Request $request)
    {
        $request->validate([
            'answer' => 'required',
         ]);
    	// dd($request);die();
    	$get_question = Question::where('status',1)->get();
    	// if($request->answer == 1)
    	// {
    	// 	echo "string";
    	// }
    	$i = 0;

    	foreach ($get_question as $value) {

    		Answer::insert([
    			'question_id' => $value->id,
    			'user_id' => Auth::id(),
    			'answer' => $request->answer[$i],
                'comment' => $request->comment,
    			'created_at' => Carbon::now(),
    		]); 
    		$i++;
    	}
    	
    	return back()->with('success','Answered Successfully');
    }
}
