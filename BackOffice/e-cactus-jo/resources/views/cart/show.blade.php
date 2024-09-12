<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Panier</title>
</head>
<body>
    <h1>Détails du Panier ID: {{ $cart->id }}</h1>
    <ul>
        @foreach($cart->items as $item)
            <li>{{ $item->sneaker_name }} - {{ $item->quantity }} x {{ $item->price }} €</li>
        @endforeach
    </ul>
    <a href="{{ route('cart.index') }}">Retour à la liste des paniers</a>
</body>
</html>