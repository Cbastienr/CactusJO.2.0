<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="https://kit.fontawesome.com/f4d92cf357.js" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&family=Rock+3D&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Handjet", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            padding-top: 180px;
        }

        h1 {
            font-family: "Rock 3D", cursive;
        }

        .form-box {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .inputbox {
            margin-bottom: 20px;
        }

        .inputbox label {
            font-size: 1.2em;
            display: block;
            margin-bottom: 5px;
        }

        .inputbox input, 
        .inputbox select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f4f4f4;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #e0e0e0;
        }

        /* Styles pour les boutons et header (repris de l'exemple sneakers) */
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

<div class="container">
    <h1>Editer le profil utilisateur</h1>

    <div class="form-box">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="inputbox">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>

            <div class="inputbox">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required>
            </div>

            <div class="inputbox">
                <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="inputbox">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <button type="submit">Mettre à jour le profil</button>
        </form>
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