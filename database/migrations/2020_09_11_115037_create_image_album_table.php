<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_album', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->unsigned();
            $table->foreignId('album_id')->unsigned();

            $table->foreign('image_id')
              ->references('id')
              ->on('images')
              ->onDelete('cascade');

            $table->foreign('album_id')
              ->references('id')
              ->on('albums')
              ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_album');
    }
}
