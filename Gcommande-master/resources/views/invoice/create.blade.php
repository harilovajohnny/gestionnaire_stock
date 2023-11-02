@extends('layouts.app')

@section('content')
    @include('partials.sucessmessage')
    <form action="" method="post">
        @csrf
    <div class="flex justify-between my-2">
        <button class="bg-blue-500 text-white border-white p-2 rounded-sm">VALIDER</button>
        <h1 class="text-2xl">Liste de Commande non-facturé</h1>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr class=" text-gray-700 uppercase text-sm leading-normal border-b-2 border-black relative top-0">
                <th class="py-4"></th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Produit</th>
            </tr>
            </thead>
        <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <input type="checkbox" name="{{$order->id}}" id="checkbox">
                        </td>
                        <td class="py-4">{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{$order->product->wording}}</td>
                    </tr>
                    @endforeach
                </tbody>
    </table>
    </form>
@endsection