<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignHtmlContract extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('contracts', function (Blueprint $table) {
            $table->longText('sign_html')->after('html')->nullable();
            $table->json('shields')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('contracts', function($table) {
            $table->dropColumn('sign_html');
            $table->dropColumn('shields');
        });
    }
}
