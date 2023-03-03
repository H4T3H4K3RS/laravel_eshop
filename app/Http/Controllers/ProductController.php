<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin')->except('index')->except('show')->except('order');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
//        $users = User::all();
        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'href' => 'required|string|max:511',
            'category' => 'required|string|max:255'
        ]);

        $product = Product::create($validated);

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

//        $user = User::find($product->user_id);  <-- эквивалентная запись
//        $user = $product->user;  <-- эквивалентная запись
//        return 'Product ' . $product->name;
//        return 'Product';

        return view('products.show')
            ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
//        return 'Product';
        return view('products.edit')
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'href' => 'required|string|max:511',
            'category' => 'required|string|max:255'
        ]);

        $product->update($validated);

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Product updated successfully');

//        $product = Product::upd($validated);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
    public function order(Request $request)
    {
        // Get the order data from the request
        $orderData = $request->input('order');
        $orderData = json_decode($orderData, true);


        // Format the order data into a message for the webhook
        $message = "New order:\n\n";
        $products = "";
        $i = 0;
        foreach($orderData as $product) {
            $i += 1;
            $message .= "**=======Product {$i}=======**\n";
            $products .= "・ {$product->name}";
            foreach ($product as $key => $value) {
                $message .= "・**{$key}:** {$value}\n";
            }
        }

        // Set up the webhook URL and payload
        $webhookUrl = 'https://discord.com/api/webhooks/1081139113920577578/5bhisy0-14PHONGc87xk-iSUZSgLfj0nvCoKtC1N1Bgs9ylzuB-6ZL-5llkKYFgxe-TU';
        $payload = [
            'content' => $message,
        ];

        // Send the message to the webhook
        $client = new \GuzzleHttp\Client();
        $response = $client->post($webhookUrl, [
            'json' => $payload,
        ]);
        $order = new Order();

        // Set the user_id attribute to the ID of the authenticated user
        $order->user_id = auth()->user()->id;
        // Set the products attribute to the order data formatted as a JSON string
//        $order->products = json_encode($orderData);
        $order->products = $products;

        // Save the order to the database
        $order->save();
        // Return a response indicating whether the message was sent successfully
        if ($response->getStatusCode() == 204) {
            return response()->json(['message' => 'Order sent to Discord webhook']);
        } else {
            return response()->json(['message' => 'Error sending order to Discord webhook'], $response->getStatusCode());
        }
    }

}
