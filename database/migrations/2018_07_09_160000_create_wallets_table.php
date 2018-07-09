<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('line_account_id')
                ->unsigned()
                ->index('wallets_line_account_id');
            $table->decimal('balance')->default(0.00);
            $table->timestamps();

            $table->foreign('line_account_id')->references('id')->on('line_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
