<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index () {
            $orders = Order::where('invoice', true)->limit(10)->get();
        return view('invoice.index', [
            'orders' => $orders
        ]);
    }

    public function create () {
        $orders = Order::where('invoice', false)->get();
        return view('invoice.create', [
            'orders' => $orders
        ]);
    }

    public function store (Request $request) {
        $invoice = new Invoice();
        $invoice->save();
        $data = [];
        foreach($request->all() as $key => $value) {
            if($key != '_token') {
                $invoice->orders()->attach($key);
                $order = Order::findOrFail($key);
                $order->invoice = true;
                $order->save();
            }
        }
        return redirect()->route('invoice.index')
        ->with('success', 'Facturation ok !');
    }
}
