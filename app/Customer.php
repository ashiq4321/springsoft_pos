<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name','phone','cus_email','a_tax','company_name','address','city','state','postal_code','country'
    ];

   
}
