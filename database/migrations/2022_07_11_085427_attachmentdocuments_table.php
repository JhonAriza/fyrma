<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttachmentdocumentsTable extends Migration
{



     
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('annexes','attachmentdocuments');
        Schema::table('attachmentdocuments', function (Blueprint $table) {
            $table->renameColumn('annexe_name', 'attachmentdocument_name');
            $table->renameColumn('annexe_document', 'attachmentdocument_document');
         });
    }
 





    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('attachmentdocuments','annexes');
        Schema::table('attachmentdocuments', function (Blueprint $table) {
            $table->renameColumn('attachmentdocument_name', 'annexe_name');
            $table->renameColumn('attachmentdocument_document', 'annexe_document');
        });
    }
}
