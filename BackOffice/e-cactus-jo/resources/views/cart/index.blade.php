<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier d'Achat</title>
    <link rel="stylesheet" href="https://kit.fontawesome.com/f4d92cf357.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&family=Rock+3D&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            position: relative;
            font-family: "Handjet", sans-serif;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }

        .header a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 80px auto 20px auto;
            padding: 20px;
        }

        .breadcrumb-option {
            margin-bottom: 20px;
        }

        .breadcrumb-option h4 {
            margin: 0;
            font-size: 1.5em;
        }

        .breadcrumb__links a {
            text-decoration: none;
            color: #007bff;
            margin-right: 5px;
        }

        .breadcrumb__links span {
            color: #555;
        }

        .shopping__cart__table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .shopping__cart__table table {
            width: 100%;
            border-collapse: collapse;
        }

        .shopping__cart__table thead th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .shopping__cart__table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        .shopping__cart__table tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .product__cart__item img {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
        }

        .quantity__item input {
            width: 50px;
            text-align: center;
        }

        .cart__close i {
            cursor: pointer;
        }

        .continue__btn, .update__btn {
            display: inline-block;
            margin-top: 10px;
        }

        .primary-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .primary-btn:hover {
            background-color: #0056b3;
        }

        /* Styles pour le modal */
        .modal {
            display: none; /* Masquer le modal par défaut */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .payment {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .payTitle {
            font-size: 1.5em;
            margin: 0;
            color: #007bff;
        }

        .payInput {
            width: 98%;
            padding: 5px 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 1em;
            font-family: "Handjet", sans-serif;
        }

        .payInput.sm {
            width: calc(33.33% - 10px);
            display: inline-block;
        }

        .cardInfo {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .payButton {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            font-family: "Handjet", sans-serif;
        }

        .payButton:hover {
            background-color: #0056b3;
        }

        .close {
            display: block;
            text-align: right;
            font-size: 1.5em;
            cursor: pointer;
            color: #aaa;
            margin-top: 10px;
        }

        .close:hover {
            color: black;
        }
    </style>
</head>
<body>

    <!-- Header Begin -->
    <header class="header">
        <a href="{{ route('sneakers.index') }}">Accueil</a>
        <a href="/shop">Boutique</a>
        <a href="/cart">Panier</a>
        <a href="/contact">Contact</a>
    </header>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <h4>Panier d'Achat</h4>
            <div class="breadcrumb__links">
                <a href="{{ route('sneakers.index') }}">Accueil</a>
                <a href="/shop">Boutique</a>
                <span>Panier d'Achat</span>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table id="cart-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ $item->image }}" alt="{{ $item->sneaker_name }}">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item->sneaker_name }}</h6>
                                                <h5>{{ number_format($item->price, 2) }} €</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="number" value="{{ $item->quantity }}" data-id="{{ $item->id }}" min="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">{{ number_format($item->price * $item->quantity, 2) }} €</td>
                                        <td class="cart__close"><i class="fa fa-close" data-id="{{ $item->id }}"></i></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Votre panier est vide.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="/shop">Continuer vos achats</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#" id="update-cart"><i class="fa fa-spinner"></i> Mettre à jour le panier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Codes de réduction</h6>
                        <form id="discount-form">
                            <input type="text" placeholder="Code promo">
                            <button type="submit">Appliquer</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Total du panier</h6>
                        <ul id="cart-total">
                            <!-- Les totaux seront ajoutés dynamiquement ici -->
                        </ul>
                        <a href="#" class="primary-btn" id="checkout">Passer à la caisse</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Checkout Modal Begin -->
    <div id="checkout-modal" class="modal">
        <div class="modal-content">
            <h2>Passer à la caisse</h2>
            <div class="payment">
                <h1 class="payTitle">Informations Personnelles</h1>
                <label>Nom et Prénom</label>
                <input type="text" placeholder="Jean Dupont" class="payInput">
                <label>Numéro de Téléphone</label>
                <input type="text" placeholder="+33 6 12 34 56 78" class="payInput">
                <label>Adresse</label>
                <input type="text" placeholder="par ex...12 Rue des Fleurs, 75000 Paris" class="payInput">

                <h1 class="payTitle">Informations de Carte</h1>
                <input type="password" class="payInput" placeholder="Numéro de Carte">
                <div class="cardInfo">
                    <input type="text" placeholder="MM" class="payInput sm">
                    <input type="text" placeholder="AAAA" class="payInput sm">
                    <input type="text" placeholder="CVV" class="payInput sm">
                </div>
                <button class="payButton">Valider la Commande</button>
                <span class="close">X</span>
            </div>
        </div>
    </div>
    <!-- Checkout Modal End -->

    <script>
        async function fetchCartData() {
            const response = await fetch('/api/cart');
            const cartData = await response.json();
            return cartData;
        }

        async function updateCart() {
            const cartItems = await fetchCartData();
            const cartTableBody = document.querySelector('#cart-table tbody');
            const cartTotal = document.querySelector('#cart-total');

            cartTableBody.innerHTML = '';
            let subtotal = 0;

            cartItems.forEach(item => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td class="product__cart__item">
                        <div class="product__cart__item__pic">
                            <img src="${item.image}" alt="${item.sneaker_name}">
                        </div>
                        <div class="product__cart__item__text">
                            <h6>${item.sneaker_name}</h6>
                            <h5>${item.price.toFixed(2)} €</h5>
                        </div>
                    </td>
                    <td class="quantity__item">
                        <div class="quantity">
                            <div class="pro-qty-2">
                                <input type="number" value="${item.quantity}" data-id="${item.id}" min="1">
                            </div>
                        </div>
                    </td>
                    <td class="cart__price">${(item.price * item.quantity).toFixed(2)} €</td>
                    <td class="cart__close"><i class="fa fa-close" data-id="${item.id}"></i></td>
                `;

                cartTableBody.appendChild(row);
                subtotal += item.price * item.quantity;
            });

            cartTotal.innerHTML = `
                <li>Subtotal <span>${subtotal.toFixed(2)} €</span></li>
                <li>Total <span>${subtotal.toFixed(2)} €</span></li>
            `;
        }

        document.addEventListener('DOMContentLoaded', updateCart);

        document.getElementById('update-cart').addEventListener('click', async () => {
            const inputs = document.querySelectorAll('#cart-table .quantity__item input');
            for (let input of inputs) {
                const itemId = input.dataset.id;
                const quantity = input.value;
                await fetch(`/api/cart/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ quantity })
                });
            }
            await updateCart();
        });

        document.getElementById('cart-table').addEventListener('click', async (event) => {
            const target = event.target;
            if (target.classList.contains('fa-close')) {
                const id = target.dataset.id;
                await fetch(`/api/cart/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                });
                await updateCart();
            }
        });

        document.getElementById('discount-form').addEventListener('submit', async (event) => {
            event.preventDefault();
            const couponCode = event.target.querySelector('input').value;
            console.log('Code promo appliqué :', couponCode);
            await updateCart();
        });

        document.getElementById('checkout').addEventListener('click', () => {
            document.getElementById('checkout-modal').style.display = 'flex';
        });

        document.querySelector('.close').addEventListener('click', () => {
            document.getElementById('checkout-modal').style.display = 'none';
        });

        document.getElementById('checkout-form').addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);
            const response = await fetch('/api/checkout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                alert('Commande passée avec succès.');
                location.reload(); // Recharger la page pour vider le panier
            } else {
                alert('Erreur lors du passage de la commande.');
            }
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>