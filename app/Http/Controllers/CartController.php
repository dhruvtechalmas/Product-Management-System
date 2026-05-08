<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

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
                "quantity" => 1,
                "stock" => $product->stock,
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
        $product = Product::find($request->product_id);

        if ($request->quantity > $product->stock) {

            return back()->with('error', 'Only ' . $product->stock . ' items available');

        }

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
                // "stock" => $value["stock"],

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

    public function increase($id)
    {
        $cart = session()->get('cart');

        $product = Product::find($id);

        if (isset($cart[$id])) {
            // STOCK CHECK
            if ($cart[$id]['quantity'] >= $product->stock) {
                $view = view('carts.cartProducts')->render();

                return response()->json([
                    'success' => $view
                ]);
            }

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);
        }

        $view = view('carts.cartProducts')->render();

        return response()->json([
            'success' => $view
        ]);
    }
    public function decrease($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;

            } else {

                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        $view = view('carts.cartProducts')->render();

        return response()->json([
            'success' => $view
        ]);
    }

}



