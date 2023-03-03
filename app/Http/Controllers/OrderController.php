<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'products' => 'required|string|max:255',
        ]);

        // Create a new order with the validated data
        $order = new Order($validated);
        $order->save();

        // Redirect back to the orders index with a success message
        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // Delete the order
        $order->delete();

        // Redirect back to the orders index with a success message
        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
