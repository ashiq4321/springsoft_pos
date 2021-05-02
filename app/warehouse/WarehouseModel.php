<?php

namespace App\warehouse;

use Illuminate\Database\Eloquent\Model;

class WarehouseModel extends Model
{
    protected $table = "warehouses";
    public $timestamps = false;
    protected $fillable=[		
        "name",
        "email",
        "phone",
        "address",
        "is_active",
    ];
}
