<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('address');
            $table->double('lat', 10, 6)->nullable();
            $table->double('lng', 10, 6)->nullable();
            $table->string('phone_number', 15);
            $table->integer('type');
            $table->string('title');
            $table->string('slug');
            $table->string('content', 2048);
            $table->integer('cost');
            $table->time('time_begin');
            $table->time('time_end');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->json('chosen_days')->nullable();
            $table->integer('views')->default(0);
            $table->integer('reviewed_by')->unsigned()->nullable();
            $table->foreign('reviewed_by')->references('id')->on('users');
            $table->dateTime('reviewed_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
