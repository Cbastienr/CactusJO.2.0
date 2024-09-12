<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Lien avec la table carts
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec la table users
            $table->integer('sneaker_id'); // ID du sneaker provenant de l'API
            $table->string('sneaker_name'); // Nom du sneaker pour affichage
            $table->decimal('price', 8, 2); // Prix du sneaker au moment de l'ajout au panier
            $table->integer('quantity'); // Quantité dans le panier
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}