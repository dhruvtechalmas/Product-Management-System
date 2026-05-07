<h2>Payment Successful</h2>

<p>
    Your payment has been completed successfully.
</p>

<p>
    Order ID: {{ $order->id }}
</p>

<p>
    Amount: ₹{{ $order->amount }}
</p>

<p>
    Thank you for shopping with us.
</p>

<a href="{{ route('invoice.download', $order->id) }}"
   class="btn btn-primary">

    Download Invoice

</a>