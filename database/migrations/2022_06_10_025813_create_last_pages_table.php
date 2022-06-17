<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('books_id');
            $table->unsignedBigInteger('pages_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('pages_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('last_pages');
    }
};
