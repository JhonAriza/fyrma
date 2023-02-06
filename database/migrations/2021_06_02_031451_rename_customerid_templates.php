<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCustomeridTemplates extends Migration {

    public function up() {
        Schema::table('templates', function (Blueprint $table) {
            $table->renameColumn('company_id', 'owner');
            $table->foreign('owner')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::table('templates', function (Blueprint $table) {
            $table->renameColumn('owner', 'company_id');
        });
    }
}

