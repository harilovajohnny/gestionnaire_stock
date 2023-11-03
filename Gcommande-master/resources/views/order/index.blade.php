@extends('layouts.app')

@section('content')
    @include('partials.sucessmessage')
    <div class="flex justify-between my-2">
        {{-- <button class="bg-blue-500 text-white border-white p-2 rounded-sm"> <a href="{{ route('product.index')}}">COMMANDER</a></button> --}}
        <h1 class="text-2xl">Liste de Commande</h1>
    </div>
    <form id="commande-form">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="produit" class="form-label">Choisir un produit:</label>
                <select id="produit" name="produit" class="form-select" required>
                    
                    @foreach ($produits as $produit)
                        <option value="{{ $produit }}">{{ $produit->wording }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="quantite" class="form-label">Quantité:</label>
                <input type="number" id="quantity" required="required" min="1" name="quantity" class="form-control">
            </div>

            <input type="hidden" name="orders" id="orders" value="[]">
                
            <div class="col-md-4">  
                <div class="form-group">  
                    <button type="submit" class="btn btn-primary">Ajouter une commande</button>
                </div>
            </div>
        </div>
    </form>
    <table class="table" id="commande-list"">
        <thead>
            <tr >
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

    <p>Total des commandes : <span id="total-commands">0</span> Ar</p>

    <button type="button" id="enregistrer-commandes" class="bg-blue-500 text-white border-white p-2 rounded-smy">Enregistrer les commandes</button>
  

    <!-- Inclure jQuery -->
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

<script>

    $(document).ready(function() {

        // fonction pour enregistrer le totalité de la commande vers le controller
        function saveOrders() {
            var ordersData = $('#orders').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('order.store') }}',
                data: {
                    orders: ordersData,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Commandes enregistrées avec succès');
                    // Vous pouvez également ajouter ici du code pour gérer la réponse du contrôleur, comme une redirection
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de lenregistrement des commandes');
                }
            });
        }

        //Fonction pour le calcule de la total de la commande
        function calculateTotal() {
            var ordersData = JSON.parse($('#orders').val());
            var total = 0;

            console.log("ordersData",ordersData)

            // Parcourez toutes les commandes pour calculer le total
            ordersData.forEach(function(order) {
                total += order.total_price;
            });

            // Mettez à jour l'affichage du total
            $('#total-commands').text(total);

            console.log("total",total);

            if (ordersData.length > 0 && total > 0) {
                $('#enregistrer-commandes').show();
            } else {
                $('#total-commands').text(0);
                $('#enregistrer-commandes').hide();
            }
        }

        
        $('#commande-form').on('submit', function(e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire
            var formData = $(this).serialize();
            var produit =JSON.parse($('#produit').val()); 
            var price = produit.purchasing_price;
            var product_name = produit.wording; 
            var product_id = produit.id; 
            
            var quantite = $('#quantity').val(); // Récupère la valeur du champ quantité
            var prixTotal = price * quantite; // Calcule le prix total
            console.log('prixttt',quantite);

            var commande = {
                product_id: product_id,
                quantity: quantite,
                total_price: prixTotal
            };

            var existingOrders = JSON.parse($('#orders').val());

            existingOrders.push(commande);

            $('#orders').val(JSON.stringify(existingOrders));


            // Créez un élément HTML pour la commande
            var commandeHtml = '<tr class=" text-gray-700 uppercase text-sm leading-normal border-b-2 border-black relative top-0">';
            commandeHtml += '<td>' + product_name + '</td>';
            commandeHtml += '<td>' + quantite + '</td>';
            commandeHtml += '<td>' + prixTotal + ' Ar </td>';
            commandeHtml += '<td>';
            commandeHtml += '<button class="bg-red-500 text-white border-white p-2 rounded-sm delete-commande" href="#">Supprimer</button>';
            commandeHtml += '</td>';
            commandeHtml += '</tr>';

            // Ajoutez la commande à la liste en bas du formulaire
            $('#commande-list tbody').append(commandeHtml);

            // Effacez les champs du formulaire
            $('#produit').val('');
            $('#quantity').val('');

            calculateTotal();
        });

        // Gérez la suppression d'une commande
        $('#commande-list').on('click', '.delete-commande', function() {

            var commandId = $(this).data('product_id');

            $(this).closest('tr').remove();
            calculateTotal();

            

            // Parcourez les commandes et supprimez celle avec l'ID correspondant
            ordersData = ordersData.filter(function(order) {
                return order.product_id !== commandId;
            });

            // Mettez à jour le champ #orders avec le tableau mis à jour
            $('#orders').val(JSON.stringify(ordersData));

        });


        $('#enregistrer-commandes').on('click', function() {
            saveOrders();
        });

        $('#enregistrer-commandes').hide();
        
       
    });
</script>


@endsection