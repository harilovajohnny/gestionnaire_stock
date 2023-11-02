@extends('layouts.app')


@section('content')

<form action="" method="post" class="flex flex-col m-24">
    @csrf
    @if($product->id)
        <label for="id">Id</label>
        <input type="text" class="p-2" name="id" id="id" disabled value="{{ old('wording', $product->id)}}">
     @endif
    <label for="wording">Libelle</label>
    <input type="text" class="p-2" name="wording" id="wording" value="{{ old('wording', $product->wording)}}">
    @error('wording')
        <span class="text-red-500 rounded-sm mt-1 mb-2">{{ $message }}*</span>
    @enderror
    <label for="purchasing_price">Prix d'achat</label>
    <input type="number" class="p-2" name="purchasing_price" id="purchasing_price" value="{{ old('purchasing_price', $product->purchasing_price)}}">
    @error('purchasing_price')
        <span class="text-red-500 rounded-sm mt-1 mb-2">{{ $message }}*</span>
    @enderror
    <label for="selling_price">Prix de vente</label>
    <input type="number" class="p-2" name="selling_price" id="selling_price" value="{{ old('selling_price', $product->selling_price)}}">
    @error('selling_price')
        <span class="text-red-500 rounded-sm mt-1 mb-2">{{ $message }}*</span>
    @enderror
    <button type="submit" class="p-2 bg-blue-500 rounded-sm font-medium text-white my-5">
        @if($product->id)
            Modifier
        @else
            Enregister  
        @endif
    </button>
</form>

@endsection