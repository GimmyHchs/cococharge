<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHookeventsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hookevents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('original_data');
            $table->text('reply_token');
            $table->string('type');
            $table->string('timestamp');
            $table->text('source');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hookevents');
    }
}
