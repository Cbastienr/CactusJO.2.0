<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartItem;

class Cart extends Model
{
    protected $fillable = [
        'user_id', // L'utilisateur propriétaire du panier
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les articles du panier
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}