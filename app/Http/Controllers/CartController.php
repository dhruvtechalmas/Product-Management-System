<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Razorpay\Api\Api;

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

        if ($request->type == "update") {
            $cart[$request->product_id]["quantity"] = $request->quantity;
        } else {
            unset($cart[$request->product_id]);
        }

        session()->put('cart', $cart);

        $view = view("carts.cartProducts")->render();

        return response()->json([
            'success' => $view
        ]);

    }

    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
        ]);

        $amount = 0;

        foreach (session("cart") as $key => $value) {

            $order->products()->create([
                "product_id" => $key,
                "quantity" => $value["quantity"],
                "price" => $value["price"],
            ]);

            $amount += ($value["quantity"] * $value["price"]);
        }

        $order->amount = $amount;
        $order->payment_status = 'pending';
        $order->save();

        // Razorpay

        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $razorpayOrder = $api->order->create([

           'receipt' => (string) $order->id,

            'amount' => $amount * 100,

            'currency' => 'INR'

        ]);

        $order->payment_id = $razorpayOrder['id'];

        $order->save();

        return view('payment', [

            'amount' => $amount * 100,

            'razorpayOrderId' => $razorpayOrder['id'],

            'order' => $order

        ]);
    }

}