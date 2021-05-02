<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    protected $table = "purchases";
    public $timestamps = false;
    protected $fillable=[		
        "name",
        "email",
        "phone",
        "address",
        "is_active",
    ];
}
