<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "description" => $product->description,
                "sku" => $product->sku,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function cart(Request $request)
    {
        return view('carts.cart');
    }

    public function cartUpdate(Request $request)
    {

        $cart = session()->get('cart');

        if ($request->type == "update"){
            $cart[$request->product_id]["quantity"] = $request->quantity;
        }else{
            unset($cart[$request->product_id]);
        }

        session()->put('cart', $cart);

        $view = view("carts.cartProducts")->render();

        return response()->json([
            'success' => $view
        ]);

    }
}
