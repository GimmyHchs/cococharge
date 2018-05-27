<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineTextsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_user_id')->unsigned();
            $table->integer('hookevent_id')->unsigned();
            $table->integer('line_id')->unsigned();
            $table->timestamps();

            //foreign Key Set
            $table->foreign('line_user_id')->references('id')->on('line_users')->onDelete('cascade');
            $table->foreign('hookevent_id')->references('id')->on('hookevents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('line_texts');
    }
}
