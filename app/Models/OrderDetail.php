<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $guarded = [];
    public function order () {
        return $this->belongsTo('App\Models\Order', 'id_order');
    }
    public function product () {
        return $this->belongsTo('App\Models\Admin', 'id_product');
    }
}
