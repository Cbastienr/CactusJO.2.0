<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&family=Rock+3D&display=swap" rel="stylesheet">
    <style>
        body {
    font-family: "Handjet", sans-serif;
    margin: 0;
    padding: 0;
    background: url('Background_product.jpeg') no-repeat center center fixed;
    background-size: cover;
}

.logo {
    width: 100px;
    height: 100px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.menuItem {
    margin-right: 50px;
    cursor: pointer;
    color: lightgray;
    font-weight: 400;
}

.form-box {
    position: relative;
    width: 400px;
    height: auto;
    background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    border: 2px solid rgba(255, 255, 255, 0.5); /* Border color with opacity */
    border-radius: 20px;
    backdrop-filter: blur(15px);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    margin: 100px auto;
}

h2 {
    font-size: 2em;
    color: #333;
    margin-bottom: 20px;
    font-family: "Rock 3D", "cursive";
}

form {
    width: 100%;
}

.inputbox {
    position: relative;
    margin: 20px 0;
    width: 100%;
    border-bottom: 2px solid #333;
}

.inputbox label {
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #333;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
}

.inputbox input {
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding: 0 35px 0 5px;
    color: #333;
}

.inputbox input:focus ~ label,
.inputbox input:not(:placeholder-shown) ~ label {
    top: -5px;
    font-size: 0.75em;
    color: #007bff;
}

button {
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background: #007bff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight: 600;
    color: #fff;
    margin-top: 20px;
    font-family: "Handjet", sans-serif;
}

button:hover {
    background: #0056b3;
}

.register {
    font-size: .9em;
    color: #fff;
    text-align: center;
    margin-top: 10px;
}

.register p a {
    text-decoration: none;
    color: #007bff;
    font-weight: 600;
}

.register p a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

<div class="form-box">
    <h2>Login</h2>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="inputbox">
            <input type="email" name="email" id="email" required placeholder=" ">
            <label for="email">Email</label>
        </div>
        <div class="inputbox">
            <input type="password" name="password" id="password" required placeholder=" ">
            <label for="password">Password</label>
        </div>
        <button type="submit">Login</button>
        <div class="register">
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </form>
</div>

</body>
</html>