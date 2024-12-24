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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();


            $table->uuid('person_id')->nullable(); 
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade')->onUpdate('cascade');

            // $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};



// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('options_privileges', function (Blueprint $table) {
//             $table->uuid('option_id');
//             $table->uuid('privilege_id');

//             $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
//             $table->foreign('privilege_id')->references('id')->on('privileges')->onDelete('cascade');

//             $table->primary(['option_id', 'privilege_id']);
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('options_privileges');
//     }
// };
