<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccessMail;
use App\Mail\PaymentFailedMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    // PAYMENT SUCCESS
    public function paymentSuccess(Request $request)
    {
        $order = Order::where('payment_id', $request->razorpay_order_id)->first();

        // ORDER NOT FOUND
        if (!$order) {

            return redirect('/cart')
                ->with('error', 'Order not found');
        }

        // ALREADY PAID
        if ($order->payment_status == 'paid') {

            return redirect('/')
                ->with('success', 'Already Paid');
        }

        // PAYMENT SUCCESS
        $order->payment_status = 'paid';

        $order->save();

        // REDUCE STOCK
        foreach ($order->products as $item) {

            $product = Product::find($item->product_id);

            if ($product) {

                $product->stock -= $item->quantity;

                // STOCK STATUS
                if ($product->stock <= 0) {

                    $product->stock = 0;

                    $product->stock_status = 'out_of_stock';

                } else {

                    $product->stock_status = 'in_stock';
                }

                $product->save();
            }
        }

        // SEND SUCCESS MAIL
        Mail::to(auth()->user()->email)
            ->send(new PaymentSuccessMail($order));

        // CLEAR CART
        session()->forget('cart');

        return redirect()->route('cart')
            ->with('success', 'Payment Successful');
    }


    // PAYMENT CANCEL
    public function paymentCancel()
    {
        $user = auth()->user();

        // SEND FAILED MAIL
        Mail::to($user->email)
            ->send(new PaymentFailedMail($user));

        return redirect('/cart')
            ->with('error', 'Payment Cancelled or Failed!');
    }
}