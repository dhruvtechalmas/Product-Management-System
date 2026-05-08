<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
        protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

        // PRODUCT RELATION
        public function product()
        {
                return $this->belongsTo(Product::class);
        }

        // ORDER RELATION
        public function order()
        {
                return $this->belongsTo(Order::class);
        }

}
