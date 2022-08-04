<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slug', function (Blueprint $table) {
            $table->id();
            $table->date('Date');
            $table->text('Details');
            $table->string('issued1625');
            $table->string('received1625');
            $table->string('Balance1625');
            $table->string('issued165');
            $table->string('received165');
            $table->string('Balance165');
            $table->string('issued1925');
            $table->string('received1925');
            $table->string('Balance1925');
            $table->string('issued195');
            $table->string('received195');
            $table->string('Balance195');
            $table->string('issued2225');
            $table->string('received2225');
            $table->string('Balance2225');
            $table->string('issued225');
            $table->string('received225');
            $table->string('Balance225');
            $table->string('issued2525');
            $table->string('received2525');
            $table->string('Balance2525');
            $table->string('issued255');
            $table->string('received255');
            $table->string('Balance255');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slug');
    }
}
