<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\User;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'sneaker_id',   // ID du sneaker depuis l'API
        'sneaker_name', // Nom du sneaker pour affichage
        'price',        // Prix du sneaker au moment de l'ajout
        'quantity',     // Quantité dans le panier
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le panier
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}