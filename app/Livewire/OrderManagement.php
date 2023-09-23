<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderManagement extends Component
{
    public $orders;
    public $product_id;
    public $client_id;
    public $quantity_ordered;

    public function render()
    {
        $this->orders = Order::all();
        return view('livewire.order-management');
    }

    public function createOrder()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required', // Add validation rules for client_id
            'quantity_ordered' => 'required|integer|min:1',
        ]);

        Order::create([
            'product_id' => $this->product_id,
            'client_id' => $this->client_id,
            'quantity_ordered' => $this->quantity_ordered,
        ]);

        $this->resetFields();
    }

    private function resetFields()
    {
        $this->product_id = null;
        $this->client_id = '';
        $this->quantity_ordered = null;
    }
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|integer',
            'quantity_ordered' => 'required|integer|min:1',
        ]);

        // Update the order with the new data

        return redirect('/orders')->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        // Delete the order

        return redirect('/orders')->with('success', 'Order deleted successfully');
    }
}
