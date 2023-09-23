<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }
    
    public function create()
    {
        return view('orders.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:users,id', // Assuming client_id is related to user IDs.
            'quantity_ordered' => 'required|integer',
        ]);
    
        Order::create($data);
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }
    
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
