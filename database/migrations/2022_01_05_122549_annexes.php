<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Annexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annexes', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('allowed_types_id');
            $table->text('annexe_name');
            $table->longText('annexe_document')->nullable();
            $table->text('participant');
            $table->text('comment')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('allowed_types_id')->references('id')->on('allowed_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annexes');
    }
}
