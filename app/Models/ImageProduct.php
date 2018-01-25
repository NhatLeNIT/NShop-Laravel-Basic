<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $table = 'image_products';
    protected $guarded = [];
    public function product () {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }
    protected $hidden = ['id', 'id_product', 'status', 'created_at', 'updated_at'];
}
