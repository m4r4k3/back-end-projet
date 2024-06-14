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
        Schema::create("experience", function (Blueprint $table){
            $table->id();
            $table->string("entr");
            $table->string("post");
            $table->string("start");
            $table->string("end");
            $table->text("description");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user")->references("id")->on("users")->onDelete('cascade');
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
