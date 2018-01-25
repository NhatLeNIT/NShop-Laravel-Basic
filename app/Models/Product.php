<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    public function cate () {
        return $this->belongsTo('App\Models\Category', 'id_cate');
    }
//    public function user () {
//        return $this->belongsTo('App\Models\Admin', 'id_user');
//    }
    public function comments () {
        return $this->hasMany('App\Models\Comment','id_product');
    }
    public function images () {
        return $this->hasMany('App\Models\ImageProduct', 'id_product');
    }
    protected $hidden = ['alias', 'keyword', 'description', 'status', 'id_user', 'created_at', 'updated_at'];
}
