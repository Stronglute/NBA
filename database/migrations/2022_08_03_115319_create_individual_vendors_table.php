<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualvendors', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->text('Description');
            $table->string('PartyName');
            $table->integer('Weight');
            $table->integer('Rate');
            $table->integer('Payment');
            $table->integer('Paid');
            $table->integer('Balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_vendors');
    }
}
