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
        Schema::create("individuel", function (Blueprint $table){
                $table->id();
                $table->string("time");
                $table->unsignedBigInteger("domain");
                $table->unsignedBigInteger("city");
                $table->string("nom");
                $table->string("prenom");
                $table->text("description");
                $table->unsignedBigInteger("user_id");
                $table->timestamps();
                $table->string("entreprise");
                $table->string("post");
                $table->string("phone");

                $table->foreign("user")->references("id")->on("users")->onDelete('cascade');
                $table->foreign("domain")->references("id")->on("domain")->onDelete('cascade');
                $table->foreign("city")->references("id")->on("city")->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
