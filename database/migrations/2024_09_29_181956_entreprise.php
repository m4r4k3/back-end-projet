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
        Schema::create("entreprise", function (Blueprint $table){
                $table->id();
                $table->string("name");
                $table->text("description")->nullable();
                $table->timestamps();
                $table->unsignedBigInteger("domain")->nullable();
                $table->unsignedBigInteger("location")->nullable();
                $table->unsignedBigInteger("image")->nullable();
                $table->unsignedBigInteger("user_id");
                $table->string("n-entreprise") ;
                $table->string("phone")->nullable();

                $table->foreign("image")->references("id")->on("image")->onDelete('cascade');
                $table->foreign("domain")->references("id")->on("domain")->onDelete('cascade');
                $table->foreign("location")->references("id")->on("city")->onDelete('cascade');
                $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
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
