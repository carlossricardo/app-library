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
        Schema::create('options', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            // $table->string('name', 100);
            // $table->string('url', 200);            
            // $table->boolean('status')->default(true);
            // $table->timestamps();

            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('icon', 70);
            $table->uuid('parent_id')->nullable(); // Relación autorreferenciada
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Clave foránea autorreferenciada
            $table->foreign('parent_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
