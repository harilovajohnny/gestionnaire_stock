@extends('layouts.app')

@section('content')
    @include('partials.sucessmessage')
    <div class="flex justify-between my-2">
        <button class="bg-blue-500 text-white border-white p-2 rounded-sm"> <a href="{{ route('invoice.create')}}">FACTURER</a></button>
        <h1 class="text-2xl">Liste de Commande facturé</h1>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr class=" text-gray-700 uppercase text-sm leading-normal border-b-2 border-black relative top-0">
                <th class="py-4">Facture</th>
                <th class="py-4">Date</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Produit</th>
            </tr>
            </thead>
        <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->invoices[0]->id }}</td>
                        <td>{{ $order->invoices[0]->created_at }}</td>
                        <td class="py-4">{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{$order->product->wording}}</td>
                    </tr>
                    @endforeach
                </tbody>
    </table>
@endsection