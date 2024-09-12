<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Sneaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Ajouté pour les logs
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // Affiche le panier
    public function index()
    {
        $cart = $this->getUserCart();
        $cartItems = $cart->items; // Récupère les items du panier

        return view('cart.index', [
            'cartItems' => $cartItems,
            'cart' => $cart
        ]);
    }

    // Ajoute un sneaker au panier
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'sneaker_id' => 'required|integer|exists:sneakers,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $sneakerId = $request->input('sneaker_id');
        $quantity = $request->input('quantity', 1);
    
        $sneaker = Sneaker::find($sneakerId);
    
        if (!$sneaker) {
            Log::error('Sneaker non trouvé', ['sneaker_id' => $sneakerId]);
            return redirect()->back()->with('error', 'Sneaker non trouvé.');
        }
    
        $cart = $this->getUserCart();
    
        $existingItem = $cart->items()->where('sneaker_id', $sneaker->id)->first();
        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
        } else {
            $cart->items()->create([
                'sneaker_id' => $sneaker->id,
                'sneaker_name' => $sneaker->name,
                'price' => $sneaker->retail_price,
                'quantity' => $quantity,
            ]);
        }
    
        return redirect()->route('cart.index')->with('success', 'Sneaker ajouté au panier.');
    }

    // Met à jour la quantité d'un article dans le panier
    public function update(Request $request, $id)
    {
        $item = CartItem::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Article non trouvé.');
        }

        $item->quantity = $request->input('quantity', $item->quantity);
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    // Supprime un article du panier
    public function destroy($id)
    {
        $item = CartItem::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Article non trouvé.');
        }

        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Article supprimé du panier.');
    }

    // Passe à la caisse
    public function checkout()
    {
        $cart = $this->getUserCart();

        // Exemple : réinitialiser le panier après paiement
        $cart->items()->delete();
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Merci pour votre achat.');
    }

    // Récupère ou crée le panier de l'utilisateur connecté
    protected function getUserCart()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Utilisateur non authentifié.');
        }

        // Assurez-vous que chaque utilisateur a un seul panier actif
        $cart = $user->cart ?: Cart::create(['user_id' => $user->id]);
        Log::info('Panier récupéré', ['cart_id' => $cart->id]);
        return $cart;
    }
}