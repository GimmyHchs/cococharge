<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineJoinEventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_join_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 15);
            $table->string('reply_token', 30);
            $table->integer('timestamp');
            $table->string('source_type', 15);
            $table->string('source_id', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('line_event_joins');
    }
}
