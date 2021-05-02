<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $table = "products";


    // public function product_to_product()
    // {
    //     return $this->belongsTo(Product::class);
    // }


    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}