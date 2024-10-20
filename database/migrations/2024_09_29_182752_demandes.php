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
        Schema::create("demandes", function (Blueprint $table){
            $table->id();
            $table->integer("salaire");
            $table->string("role");
            $table->timestamps();
            $table->text("description");
            $table->integer("experience");
            $table->string("niveau");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("domain");
            $table->unsignedBigInteger("location");
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("domain")->references("id")->on("domain")->onDelete('cascade');
            $table->foreign("location")->references("id")->on("city")->onDelete('cascade');
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
