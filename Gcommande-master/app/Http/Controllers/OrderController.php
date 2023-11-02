<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index () {
        $orders = Order::paginate(10);
        $produits = Product::all();

        return view('order.index', [
            'orders' => $orders,
            'produits' => $produits
        ]);
    }
    public function create (string $product) {
        $order = new Order();
        return view('order.form', [
            'product' => $product,
            'order' => $order
        ]);
    }
    public function store (string $product, CreateOrderRequest $request) {
        
        $productData = Product::findOrFail($product);
        $order = new Order([
            'quantity' => $request->validated('quantity'),
            'price' =>  $request->validated('quantity')*$productData->selling_price,
        ]);
        $order->product_id= $product;
        $order->save(); 

        return redirect()->route('order.index')
        ->with('success', 'Commande enregistré!');
    }

    public function show (string $id) {
        $order = Order::findOrFail($id);
        return view('order.form', [
            'order' => $order
        ]);
    }

    public function update (string $id, CreateOrderRequest $request) {
        $order = Order::findOrFail($id);
        $order->update([
            'quantity' => $request->validated('quantity'),
            'price' =>  $request->validated('quantity')*$order->product->selling_price,
        ]);
        return redirect()->route('order.index')
        ->with('success', 'Commande modifiée!');
    }

    public function delete(string $id) {
        Order::findOrFail($id)->delete();
        return redirect()->route('order.index')
        ->with('success', 'Commande supprimée!');
    }
}
