<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineMessageStickersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_message_stickers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->string('message_id', 20);
            $table->string('type', 15);
            $table->string('package_id', 20);
            $table->string('sticker_id', 20);
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
        Schema::dropIfExists('line_message_stickers');
    }
}
