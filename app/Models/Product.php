<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $fillable = [
    'name',
    'sku',
    'category_id',
    'price',
    'quantity',
    'description',
    'image',
    'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
