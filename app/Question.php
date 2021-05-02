<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public function connect_to_category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }
}
