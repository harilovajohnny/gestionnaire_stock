@extends('layouts.app')

@section('content')
    @include('partials.sucessmessage')
    <div class="flex justify-between my-2">
        <button class="bg-blue-500 text-white border-white p-2 rounded-sm"> <a href="{{ route('product.create')}}">AJOUTER</a></button>
        <h1 class="text-2xl">Liste de produit</h1>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr class=" text-gray-700 uppercase text-sm leading-normal border-b-2 border-black relative top-0">
                <th class="py-4">Id</th>
                <th>Libellé</th>
                <th>Prix d'achat</th>
                <th>Prix de vente</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="py-4">{{ $product->id }}</td>
                <td>{{ $product->wording }}</td>
                <td>{{ $product->purchasing_price }}</td>
                <td>{{ $product->selling_price }}</td>
                <td>
                <a class="bg-yellow-500 text-white border-white p-2 rounded-sm" href="{{ route('product.show', ['id' => $product->id]) }}">Modifier</a> 
                <a class="bg-yellow-500 text-white border-white p-2 rounded-sm" href="{{ route('order.create', ['product' => $product->id]) }}">Commander</a>
                <a class="bg-red-500 text-white border-white p-2 rounded-sm" href="{{ route('product.delete', ['id' => $product->id]) }}">Supprimer</a>                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection