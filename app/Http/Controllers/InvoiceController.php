<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download($id)
    {
        // Fetch Order with Products

        $order = Order::with('products')->findOrFail($id);

        // Calculate Subtotal

        $subtotal = 0;

        foreach ($order->products as $item) {

            $subtotal += $item->price * $item->quantity;
        }

        // GST

        $tax = ($subtotal * 18) / 100;

        // Shipping Charge

        $shipping = 100;

        // Final Total

        $total = $subtotal + $tax + $shipping;

        // Generate PDF

        $pdf = Pdf::loadView('invoice', compact(
            'order',
            'subtotal',
            'tax',
            'shipping',
            'total'
        ))->setOptions([
                    'isRemoteEnabled' => true
                ]);

        return $pdf->download('invoice.pdf');
    }
}