<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index () {
        return view('product.index', [
            'products' => Product::paginate(10)
        ]);
    }

    public function create () {
        $product = new Product();
        return view('product.form', [
            'product' => $product
        ]);
    }

    public function store (CreateProductRequest $request) {
        Product::create($request->validated());
        return redirect()->route('product.index')
        ->with('success', 'Produit '. $request->input('wording') . ' bien ajouté!');
    }


    public function show (string $id) {
        $product = Product::find($id);
        return view('product.form', [
            'product' => $product
        ]);
    }

    public function update (string $id, CreateProductRequest $request) {
        $product = Product::find($id);
        $product->update($request->validated());
        return redirect()->route('product.index')
        ->with('success', 'Produit bien modifié!');
    }

    public function delete (string $id) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')
        ->with('success', 'Produit '. $product->wording . ' bien supprimé!');
    }
}
