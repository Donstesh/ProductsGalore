<div>
    <form wire:submit.prevent="createOrder">
        <!-- Form fields for creating an order -->
    </form>

    <hr>

    <h3>Order List</h3>
    <ul>
        @foreach ($orders as $order)
            <li>{{ $order->product->name }} - Quantity: {{ $order->quantity_ordered }}</li>
        @endforeach
    </ul>
</div>
