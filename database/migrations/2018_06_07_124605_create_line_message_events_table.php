<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineMessageEventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_message_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_account_id')
                ->unsigned()
                ->nullable()
                ->index('line_message_events_line_account_id');
            $table->string('type', 15);
            $table->string('message_type', 15);
            $table->string('reply_token', 50);
            $table->timestamp('timestamp');
            $table->string('source_type', 15);
            $table->string('source_id', 50);
            $table->text('origin_data');
            $table->timestamps();

            //foreign Key Set
            $table->foreign('line_account_id')->references('id')->on('line_accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('line_message_events');
    }
}
