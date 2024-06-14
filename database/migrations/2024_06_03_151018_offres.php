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
           Schema::create("offres", function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("domain_id");
            $table->unsignedBigInteger("city");
            $table->integer("salary");
            $table->text("characteristic");
            $table->text("description");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("type_contrat");
            $table->timestamps();
            $table->date("starting");

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
