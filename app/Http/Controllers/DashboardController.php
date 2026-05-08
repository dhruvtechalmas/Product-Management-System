<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $activeProducts = Product::where('status', 1)
            ->count();

        $categoriesCount = Category::count();

        $totalOrders = Order::count();

        $totalUsers = User::count();

        $totalRevenue = Order::where('payment_status', 'paid')
            ->sum('amount');

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->get();

        $outOfStock = Product::where('stock', 0)
            ->count();

        $latestOrders = Order::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(

            'totalProducts',
            'activeProducts',
            'outOfStock',
            'categoriesCount',

            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'lowStockProducts',
            'latestOrders'

        ));
    }
}