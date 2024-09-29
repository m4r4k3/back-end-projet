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
                $table->string("time")->nullable();
                $table->unsignedBigInteger("domain")->nullable();
                $table->unsignedBigInteger("city")->nullable();
                $table->string("nom");
                $table->string("prenom");
                $table->text("description")->nullable();
                $table->unsignedBigInteger("user_id");
                $table->timestamps();
                $table->string("entreprise")->nullable();
                $table->string("post")->nullable();
                $table->string("phone")->nullable();

                $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
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
