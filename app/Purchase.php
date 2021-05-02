<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
   protected $guarded = [];


   public function supplier()
     {
          return $this->belongsTo(supplier::class, 'supplier_id');
     }
}