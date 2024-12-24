<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            
            $table->uuid('id')->primary();


            $table->uuid('user_id'); // UUID de la relación con 'categories'
            $table->uuid('book_id'); // UUID de la relación con 'books'

            // Clave primaria compuesta
            // $table->primary(['book_id', 'category_id']);

            // Claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');


            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK a usuarios
            // $table->foreignId('book_id')->constrained('books')->onDelete('cascade'); // FK a libros
            $table->integer('quantity')->default(1); // Cantidad del libro
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
