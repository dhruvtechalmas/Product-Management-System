<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(){
   
    $totalProducts = Product::count();

    $activeProducts = Product::where('status', 1)->count();

    $outOfStock = Product::where('status',0)->count();

     $categoriesCount = Category::count();

    return view('dashboard',compact('totalProducts','activeProducts','outOfStock','categoriesCount'));
    }
}
