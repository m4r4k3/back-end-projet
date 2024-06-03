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
            $table->string("name")->unique();
            $table->text("description");
            $table->string("location");
            $table->unsignedBigInteger("image");
            $table->unsignedBigInteger("user_id");

            $table->index('user_id');
            $table->index('image');

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("image")->references("id")->on("image")->onDelete("cascade");
       }) ;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
