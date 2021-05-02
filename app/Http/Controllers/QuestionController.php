<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Carbon\Carbon;
use App\Answer;
use App\Category;

use DB;

class QuestionController extends Controller
{
    public function addquestion()
    {
		$questions = Question::orderBy('id','asc')->paginate(10);
		$get_category = Category::where('status',1)->get();
    	return view('admin.question.index',compact('questions','get_category'));
    }
    public function questionpost(Request $request)
    {

    	$request->validate([
    		'category_id' => 'required',
			'question' => 'required',
			'status' => 'required',
		],[
			'question.required' => 'Question Required',
		]);
    	Question::insert([
    		'category_id' => $request->category_id,
			'question' => $request->question,
			'status' => $request->status,
    		'created_at' => Carbon::now(),
    	]);
    	return back()->with('success','Question Add Successfully');
	}
	public function question_active($question_id)
    {
    	$question = Question::find($question_id);
        
        if ($question->status == 0) {
            Question::find($question_id)->update([
                'status' => 1,
            ]);
        } else {
            Question::find($question_id)->update([
                'status' => 0,
            ]);
        }
        
        return back();
	}
	public function edit_question($question_id)
	{
		$get_question = Question::find($question_id);
		return view('admin.question.edit',compact('get_question'));
	}
	public function edit_questionpost(Request $request)
	{
		$request->validate([
			'question' => 'required',
			'status' => 'required',
		],[
			'question.required' => 'Question Required',
		]);
		Question::find($request->id)->update([
			'question' => $request->question,
			'status' => $request->status,
			'created_at' => Carbon::now(),
		]);
		return back()->with('success','Question Update Successfully');
	}
	public function delete_question($question_id)
	{
		Question::find($question_id)->delete();
		$get_answer = Answer::where('question_id',$question_id)->first();
		$get_answer_id = $get_answer->question_id;
		if($question_id == $get_answer_id)
		{
			Answer::where('question_id',$get_answer_id)->delete();
		}
		return back()->with('delete','Question Delete Successfully');
	}

}
