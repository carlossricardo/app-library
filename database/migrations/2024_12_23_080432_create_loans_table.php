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
        Schema::create('loans', function (Blueprint $table) {
            // $table->id();
            
            
            $table->uuid('id')->primary();

            $table->uuid('user_id'); 

            // Definimos la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date_returned');
            $table->bigInteger('total_units');
            $table->enum('status', ['active', 'accepted', 'returned', 'overdue', 'rejected'])->default('active');
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};