<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineAccountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('line_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 15);
            $table->string('line_id', 50)->index('line_accounts_line_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('line_accounts');
    }
}
