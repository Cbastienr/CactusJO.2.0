<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'sneaker_id',  // ID du sneaker venant de l'API
        'sneaker_name',
        'quantity',
        'price'
    ];

    // Relation avec la commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}