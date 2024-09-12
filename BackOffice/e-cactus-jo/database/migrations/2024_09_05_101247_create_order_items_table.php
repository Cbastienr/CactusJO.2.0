<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Lien avec la commande
            $table->integer('sneaker_id'); // ID du sneaker provenant de l'API
            $table->string('sneaker_name'); // Nom du sneaker au moment de l'achat
            $table->integer('size'); // Taille du sneaker
            $table->decimal('price', 8, 2); // Prix au moment de l'achat
            $table->integer('quantity'); // Quantité achetée
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}