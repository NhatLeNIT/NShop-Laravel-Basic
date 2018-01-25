<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];
    public function user () {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
    public function detail () {
        return $this->hasMany('App\Models\OrderDetail','id_order');
    }
}
