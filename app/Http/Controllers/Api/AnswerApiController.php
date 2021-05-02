<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\User;
use Auth;
use Carbon\Carbon;

class AnswerApiController extends Controller
{
    public function answer(Request $request, $id)
   
    {    
// return response()->json($request, 201);
        $get_question = Question::where('status',1)->get();
        $get_user = User::where('role',1)->get();
        // return response()->json($get_question, 201);
        // if($request->answer == 1)
        // {
        //  echo "string";
        // }
        // $i = 0;
        // $d = explode(',',$request->answer);
        // return $d;
        // foreach ($get_question as $value) {
        // $get_id = $request->user_id;
        
        //     if (Auth::id() == $request->user_id) {
        //         $answer = Answer::insert([
        //             'question_id' => $id,
        //             'user_id' => $request->user_id,
        //             'answer' => $request->answer,
        //             'comment' => $request->comment,
        //             'created_at' => Carbon::now(),
        //         ]);
        //         if($answer)
        //         {   
        //             $d=array();
        //             $d=['status'=>'Answer submitted '];
        //             return response()->json($d, 201);
        //         }
        // }
        // else 
        // {
        //     echo 'sorry'
        // }
            $get_user = User::find($request->user_id);
            $get_id = $get_user->id;
        
            if ($get_id == $request->user_id) {
                $answer = Answer::insert([
                'question_id' => $id,
                'user_id' => $get_id,
                'answer' => $request->answer,
                'comment' => $request->comment,
                'created_at' => Carbon::now(),
            ]); 
        //     $i++;
        // }
                if($answer)
                {   
                    $d=array();
                    $d=['status'=>'Answer submitted '];
                    return response()->json($d, 201);
                }
                else
                {
                    $d=array();
                    $d=['status'=>'Answer submition Failed'];
                    return response()->json($d, 201);
                }
            }
            else{
                $d=array();
                $d=['status'=>'Authentication Failed'];
                return response()->json($d, 201);
            }

           
    }
}
