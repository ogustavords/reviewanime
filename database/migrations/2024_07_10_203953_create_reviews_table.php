<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('anime_id')->constrained()->onDelete('cascade');
        $table->integer('rating')->nullable()->check('rating >= 1 and rating <= 10'); // Torna o rating opcional
        $table->text('comment');
        $table->timestamps();
    });
}

    

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
