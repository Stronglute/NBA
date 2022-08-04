<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualPartyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualparty', function (Blueprint $table) {
            $table->id();
            $table->date("Dated");
            $table->string('Inv');
            $table->text('ProductDetails');
            $table->string('Billed');
            $table->string('STax');
            $table->string('ITax');
            $table->string('Payable');
            $table->string('Total');
            $table->string('ChqPay');
            $table->string('Balance');
            $table->string('PartyName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_party');
    }
}
