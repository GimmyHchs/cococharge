<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineFollowEventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_follow_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 15);
            $table->string('reply_token', 50);
            $table->timestamp('timestamp');
            $table->string('source_type', 15);
            $table->string('source_id', 50);
            $table->text('origin_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('line_follow_events');
    }
}
