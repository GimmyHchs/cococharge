<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineMessageTextsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_message_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->string('message_id', 10);
            $table->text('text');
            $table->timestamps();

            //foreign Key Set
            $table->foreign('event_id')->references('id')->on('line_message_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('line_message_texts');
    }
}
