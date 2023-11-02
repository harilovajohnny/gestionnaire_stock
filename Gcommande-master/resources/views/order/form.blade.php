@extends('layouts.app')


@section('content')

<form action="" method="post" class="flex flex-col m-24">
    @csrf
    <label for="id">Produit</label>
    <input type="text" class="p-2" name="product_id" disabled id="product_id" value="{{ old('wording', $product)}}">
    <label for="quantity">Quantité</label>
    <input type="number" class="p-2" name="quantity" id="quantity" value="{{ old('quantity', $order->quantity)}}">
    @error('quantity')
        <span class="text-red-500 rounded-sm mt-1 mb-2">{{ $message }}*</span>
    @enderror
    <button type="submit" class="p-2 bg-blue-500 rounded-sm font-medium text-white my-5">
        @if($order->id)
            Modifier
        @else
            Commander  
        @endif
    </button>
</form>

@endsection