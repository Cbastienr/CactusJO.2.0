<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    // Affiche tous les articles du panier (peut-être non nécessaire si déjà géré dans CartController)
    public function index()
    {
        $cartItems = CartItem::all(); // Assurez-vous que c'est bien ce dont vous avez besoin
        return view('cartItems.index', ['cartItems' => $cartItems]);
    }

    // Affiche un article spécifique
    public function show($id)
    {
        $item = CartItem::find($id);
        if (!$item) {
            return redirect()->route('cartItems.index')->with('error', 'Article non trouvé.');
        }
        return view('cartItems.show', ['item' => $item]);
    }

    // Ajoute un article au panier (vérifiez si c'est nécessaire ici, sinon, laissez-le dans CartController)
    public function store(Request $request)
    {
        CartItem::create($request->all());
        return redirect()->route('cartItems.index')->with('success', 'Article ajouté.');
    }

    // Met à jour un article dans le panier
    public function update(Request $request, $id)
    {
        $item = CartItem::find($id);
        if (!$item) {
            return redirect()->route('cartItems.index')->with('error', 'Article non trouvé.');
        }
        $item->update($request->all());
        return redirect()->route('cartItems.index')->with('success', 'Article mis à jour.');
    }

    // Supprime un article du panier
    public function destroy($id)
    {
        $item = CartItem::find($id);
        if (!$item) {
            return redirect()->route('cartItems.index')->with('error', 'Article non trouvé.');
        }
        $item->delete();
        return redirect()->route('cartItems.index')->with('success', 'Article supprimé.');
    }
}