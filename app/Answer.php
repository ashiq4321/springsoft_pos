<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
   protected $guarded = [];
   public function connect_to_question()
   {
   		return $this->belongsTo('App\Question','question_id');
   }
   public function connect_to_user()
   {
   		return $this->belongsTo('App\User','user_id');
   }
}
