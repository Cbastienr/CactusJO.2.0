<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Liste tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Affiche les détails d'un utilisateur
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Affiche le formulaire d'inscription
    public function create()
    {
        return view('auth.register'); // Assure-toi que le chemin est correct
    }

    // Enregistre un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login'); // Redirige vers la page de connexion après l'inscription
    }

    // Gère la connexion d'un utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/sneakers'); // Redirige vers une page après connexion
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Les informations de connexion sont incorrectes.',
            ]);
        }
    }

    // Affiche le formulaire de modification d'un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Met à jour les informations d'un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index');
    }

    // Supprime un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    // Déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Obtient le panier de l'utilisateur connecté
    protected function getUserCart()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors('Vous devez être connecté pour accéder à votre panier.');
        }

        return $user->cart ?: Cart::create(['user_id' => $user->id]);
    }

    // Affiche le panier de l'utilisateur connecté
    public function showCart()
    {
        $cart = $this->getUserCart();
        $cartItems = $cart->items;

        return view('cart.index', compact('cartItems'));
    }
}