@extends('layouts.app')

@section('content')
    @include('partials.sucessmessage')
    <div class="flex justify-between my-2">
        <button class="bg-blue-500 text-white border-white p-2 rounded-sm"> <a href="{{ route('product.index')}}">COMMANDER</a></button>
        <h1 class="text-2xl">Liste de Commande</h1>
    </div>
    <form id="commande-form">
        @csrf
        <div class="mb-3">
            <label for="produit" class="form-label">Choisir un produit:</label>
            <select id="produit" name="produit" class="form-select" required>
                
                @foreach ($produits as $produit)
                    <option value="{{ $produit }}">{{ $produit->wording }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité:</label>
            <input type="number" id="quantity" required="required" name="quantity" class="form-control">
        </div>
        <button type="submit" class="bg-blue-500 text-white border-white p-2 rounded-smy">Ajouter une commande</button>
    </form>
    <table class="min-w-full bg-white" id="commande-list"">
        <thead>
            <tr class=" text-gray-700 uppercase text-sm leading-normal border-b-2 border-black relative top-0">
                <!-- <th >Id</th> -->
                <th class="py-4">Produit</th>
                <th>Quantité</th>   
                <th>Prix</th>
                <th>Action</th>
            </tr>
            </thead>
        <tbody id="commande-list">
            
            {{-- @foreach($orders as $order)
            <tr>
                <td class="py-4">{{ $order->quantity }}</td>
                <td>{{ $order->price }}</td>
                <td>{{$order->product->wording}}</td>
                <td>
                <a class="bg-yellow-500 text-white border-white p-2 rounded-sm" href="{{ route('order.show', ['id' => $order->id]) }}">Modifier</a>
                <a class="bg-red-500 text-white border-white p-2 rounded-sm" href="{{ route('order.delete', ['id' => $order->id]) }}">Supprimer</a> 
            </tr>
            @endforeach --}}
        </tbody>
    </table>

    <!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).ready(function() {

        $('#commande-form').on('submit', function(e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire
            var formData = $(this).serialize();
            var produit =JSON.parse($('#produit').val()); 
            var price = produit.purchasing_price;
            var product_name = produit.wording; 
            console.log("product_name",product_name)
            var quantite = $('#quantity').val(); // Récupère la valeur du champ quantité
            var prixTotal = price * quantite; // Calcule le prix total
            console.log('prixttt',quantite);

            // Créez un élément HTML pour la commande
            var commandeHtml = '<tr class=" text-gray-700 uppercase text-sm leading-normal border-b-2 border-black relative top-0">';
            commandeHtml += '<td>' + product_name + '</td>';
            commandeHtml += '<td class="py-4">' + quantite + '</td>';
            commandeHtml += '<td>' + prixTotal + '</td>';
            commandeHtml += '<td>';
            commandeHtml += '<a class="bg-red-500 text-white border-white p-2 rounded-sm delete-commande" href="#">Supprimer</a>';
            commandeHtml += '</td>';
            commandeHtml += '</tr>';

            // Ajoutez la commande à la liste en bas du formulaire
            $('#commande-list tbody').append(commandeHtml);

            // Effacez les champs du formulaire
            $('#produit').val('');
            $('#quantite').val('');
        });

        // Gérez la suppression d'une commande
        $('#commande-list').on('click', '.delete-commande', function() {
            $(this).closest('tr').remove();
        });
        //add


        // Soumission du formulaire via Ajax
        // $('#commande-form').on('submit', function(e) {
        //     e.preventDefault(); // Empêche la soumission normale du formulaire
        //     var formData = $(this).serialize();
            
        //     console.log("test",formData);
        //     $.ajax({
        //         type: 'POST',
        //         url:'{{ url('order') }}/' + 1 + '/new', 
        //         data: formData,
        //         success: function(response) {
        //             // Mise à jour de la liste des commandes
        //             $('#commande-list').html(response);
        //         }
        //     });
        // });

        // Suppression de commande via Ajax
        $('#commande-list').on('click', '.delete-commande', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            // $.ajax({
            //     type: 'DELETE',
            //     url: '{{ url('commande/delete') }}/' + id,
            //     success: function(response) {
            //         // Mise à jour de la liste des commandes
            //         $('#commande-list').html(response);
            //     }
            // });
        });
    });
</script>


@endsection