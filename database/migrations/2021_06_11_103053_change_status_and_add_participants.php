<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusAndAddParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('client');
            $table->dropColumn('doc_client');
            $table->dropColumn('email_client');
            $table->dropColumn('name');

            $table->json('status')->change();
            $table->json('participants')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function($table) {
            $table->string('client');
            $table->string('doc_client');
            $table->string('email_client');
            $table->string('name');
            $table->string('status');
            $table->dropColumn('participants');
        });
    }
}
