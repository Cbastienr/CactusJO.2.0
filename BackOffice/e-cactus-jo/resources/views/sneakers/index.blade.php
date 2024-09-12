<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Sneakers</title>
    <link rel="stylesheet" href="https://kit.fontawesome.com/f4d92cf357.js" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&family=Rock+3D&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            position: relative;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 180px; /* Ajusté pour l'en-tête fixe et la bannière */
        }

        .banner {
            width: 100%;
            height: 200px;
            background: url('{{ asset("img/footpatrol.jpeg") }}') no-repeat center center;
            background-size: cover;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            padding: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-family: "Rock 3D", "cursive";
        }

        .search-bar input {
            width: 80%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .sneaker-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .sneaker-item {
            background-color: #fff;
            border: 1px solid #00FF1F;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            font-family: "Handjet", sans-serif;
        }

        .sneaker-item:hover {
            transform: scale(1.05);
        }

        .sneaker-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .sneaker-item h2 {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .sneaker-item p {
            font-size: 1em;
            color: #555;
        }

        .buy-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .buy-button:hover {
            background-color: #0056b3;
        }

        /* Styles pour les boutons de navigation */
        .button {
            color: white;
            font-size: 24px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            width: 50px;
            height: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            position: fixed;
            z-index: 1000;
            transition: background 0.3s ease;
            animation: spin 6s linear infinite;
        }

        .button:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        #menu-button {
            top: 10px;
            left: 10px;
        }

        #logo {
            width: 100px;
            height: 100px;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            animation: spin 4s linear infinite;
        }

        #user-icon {
            top: 10px;
            right: 10px;
            position: fixed;
        }

        #cart-icon {
            bottom: 10px;
            right: 10px;
            position: fixed;
        }

        #review-icon {
            bottom: 10px;
            right: 70px;
            position: fixed;
        }

        #social-icon {
            bottom: 10px;
            left: 10px;
            position: fixed;
        }

        /* Styles pour l'image utilisateur et le dropdown */
        .user-image {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .user-dropdown, .menu-dropdown, .social-dropdown {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 150px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-family: "Handjet", sans-serif;
        }

        .user-dropdown a, .menu-dropdown a, .social-dropdown a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .user-dropdown a:hover, .menu-dropdown a:hover, .social-dropdown a:hover {
            background-color: #f0f0f0;
        }

        .menu-dropdown {
            top: 60px;
            left: 10px;
        }

        .social-dropdown {
            bottom: 60px;
            left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<header>
    <a href="#" class="button" id="menu-button">
        <img src="{{ asset('img/Menu_Alt_04.png') }}" alt="Menu">
    </a>
    <a href="{{ route('sneakers.index') }}"><img src="{{ asset('img/Cactus_Joe.svg') }}" alt="Logo" id="logo"></a>
    <a href="#" class="button" id="user-icon">
        <img src="{{ asset('img/cactus_user.png') }}" alt="User Image" class="user-image">
    </a>
    <a href="{{ route('cart.index') }}" class="button" id="cart-icon">
        <img src="{{ asset('img/Shopping_Cart_01.png') }}" alt="Panier">
    </a>
    <a href="#" class="button" id="social-icon">
        <img src="{{ asset('img/Globe.png') }}" alt="Social">
    </a>
</header>

<div class="banner"></div>

<!-- Barre de recherche -->
<div class="search-bar">
    <input type="text" placeholder="Rechercher des sneakers...">
</div>

<!-- Liste déroulante utilisateur -->
<div class="user-dropdown" id="user-dropdown">
    <a href="#">Profil</a>
    <a href="#">Paramètres</a>
    <a href="#">Déconnexion</a>
</div>

<!-- Liste déroulante menu -->
<div class="menu-dropdown" id="menu-dropdown">
    <a href="#">Sneakers 👟</a>
    <a href="#">Releases 📫</a>
    <a href="#">Calendrier 📅</a>
    <a href="#">Cclean 🧽</a>
</div>

<!-- Liste déroulante réseaux sociaux -->
<div class="social-dropdown" id="social-dropdown">
    <a href="#">Réseaux</a>
    <a href="#">RSE</a>
    <a href="#">FAQ</a>
</div>

<div class="container">
    <h1>Bienvenue chez KAKTUS JOe</h1>

    <div class="sneaker-grid">
        @foreach($sneakers as $sneaker)
            <div class="sneaker-item">
                <figure>
                    <!-- Vérification si l'image est disponible -->
                    @if(isset($sneaker['image']['original']))
                        <img src="{{ $sneaker['image']['original'] }}" alt="Image de {{ $sneaker['name'] }}" class="sneaker-image">
                    @else
                        <p>Image non disponible</p>
                    @endif
                </figure>
                <h2>{{ $sneaker['name'] }}</h2>
                <p>{{ $sneaker['brand'] }}</p>
                <p><strong>Prix : </strong>{{ $sneaker['retail_price'] }} €</p>
                <form action="{{ route('cart.store') }}" method="POST">
    @csrf
    <input type="hidden" name="sneaker_id" value="{{ $sneaker->id }}">
    <input type="number" name="quantity" value="1" min="1" style="width: 60px; text-align: center;">
    <button type="submit" class="buy-button">Ajouter au panier</button>
</form>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Dropdown pour le menu
    const menuButton = document.getElementById('menu-button');
    const menuDropdown = document.getElementById('menu-dropdown');
    menuButton.addEventListener('click', () => {
        menuDropdown.style.display = menuDropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Dropdown pour l'utilisateur
    const userIcon = document.getElementById('user-icon');
    const userDropdown = document.getElementById('user-dropdown');
    userIcon.addEventListener('click', () => {
        userDropdown.style.display = userDropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Dropdown pour les réseaux sociaux
    const socialIcon = document.getElementById('social-icon');
    const socialDropdown = document.getElementById('social-dropdown');
    socialIcon.addEventListener('click', () => {
        socialDropdown.style.display = socialDropdown.style.display === 'block' ? 'none' : 'block';
    });
</script>

</body>
</html>