<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('doc_client');
            $table->string('email_client');
            $table->string('name');
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('company_id');
            $table->enum('status', ['completed', 'progress', 'cancelled','read']);
            $table->json('vars');
            $table->longText('html');
            $table->timestamps();
            
            $table->foreign('document_id')->references('id')->on('documents');    
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
