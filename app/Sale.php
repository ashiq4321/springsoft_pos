<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $gurded = [];
    protected $table = 'sales';
    protected $fillable = [
        'reference_no', 'user_id', 'Customer_id', 'warehouse_id', 'biller_id', 'item', 'total_qty', 'total_discount', 'total_tax', 'total_price', 'grand_total', 'order_tax_rate', 'order_tax', 'order_discount', 'cupon_id', 'cupon_discount', 'shipping_cost', 'sale_status', 'payment_status', 'document', 'paid_amount', 'sale_note', 'staff_note'

    ];
}