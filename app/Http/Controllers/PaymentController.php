<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccessMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {

            return redirect('/')
                ->with('error', 'Order not found');

        }

        $order->update([
            'payment_status' => 'paid'
        ]);

        // Send Mail

       Mail::to(auth()->user()->email)
            ->send(new PaymentSuccessMail($order));

        // Clear Cart

        session()->forget('cart');

        return redirect('/')
            ->with('success', 'Payment Successful');
    }
}
