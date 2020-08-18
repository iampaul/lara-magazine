<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->bigIncrements('magazine_id');
            $table->string('name',255);
            $table->string('image',255)->nullable();
            $table->double('price',8,2);
            $table->enum('frequency', ['week', 'month', 'year'])->default('week');
            $table->string('stripe_id',255)->nullable();
            $table->enum('status',['ACTIVE', 'DISABLED'])->default('DISABLED');
            $table->timestamps();

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazines');
    }
}
