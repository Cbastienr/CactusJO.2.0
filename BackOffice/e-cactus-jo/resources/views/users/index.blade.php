<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('Background_product.jpeg') no-repeat center center fixed;
            background-size: cover;
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

        /* Boutons similaires au style du header de la page sneakers */
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

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-size: 1em;
        }

        td {
            font-size: 0.9em;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a, button {
            color: #007bff;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c82333;
        }

        .actions {
            display: flex;
            gap: 10px;
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
    <h2>Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="actions">
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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