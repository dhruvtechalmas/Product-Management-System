<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use SoftDeletes;
    use HasFactory;

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
