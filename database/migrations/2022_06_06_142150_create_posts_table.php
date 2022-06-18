<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            // usersのidと同じデータ型に設定する
            // bigIncrementsで設定されるデータ型はunsignedBigInteger
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->string('image', 100);
            $table->string('image2', 100);
            $table->string('description',10000);
            $table->unsignedBigInteger('place_id');
            $table->timestamps();
            // user_id は users の id に対して外部キー制約を設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
