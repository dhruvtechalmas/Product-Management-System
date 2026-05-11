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

        // LOGO TO BASE64

        $logoPath = public_path('Invoicelogo.png');

        $logoBase64 = '';

        if (file_exists($logoPath)) {

            $type = pathinfo($logoPath, PATHINFO_EXTENSION);

            $imageData = base64_encode(file_get_contents($logoPath));

            //  dd($imageData);


            $logoBase64 = 'data:image/png;base64,' . $imageData;

        }


        // Generate PDF

        $pdf = Pdf::loadView('invoice', compact(
            'order',
            'subtotal',
            'tax',
            'shipping',
            'total',
            'logoBase64'
        ))->setOptions([
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                    'defaultFont' => 'sans-serif',
                ]);

        return $pdf->download('invoice.pdf');
    }
}