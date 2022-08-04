<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capproduction', function (Blueprint $table) {
            $table->id();
            $table->date("Date");
            $table->text('Description');
            $table->string('Length');
            $table->string('Color');
            $table->string('Cap');
            $table->string('Production');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capproduction');
    }
}
