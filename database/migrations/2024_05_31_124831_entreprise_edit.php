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
        Schema::create("individuel",function (Blueprint $table){
            $table->id();
           $table->string("time")->nullable();
            $table->unsignedBigInteger("domain")->nullable();
            $table->unsignedBigInteger("image")->nullable();
            $table->unsignedBigInteger("city")->nullable();
            $table->string("nom")->nullable();
            $table->string("prenom")->nullable();
            $table->string("description")->nullable();
            $table->unsignedBigInteger("user_id") ;
            $table->timestamps();
                        $table->foreign("image")->references("id")->on("image")->onDelete("cascade");
                        $table->foreign("city" )->references("id")->on("city") ->onDelete("cascade");
                        $table->foreign("user_id" )->references("id")->on("users") ->onDelete("cascade");
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


