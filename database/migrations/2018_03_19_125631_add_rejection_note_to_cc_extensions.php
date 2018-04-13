<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRejectionNoteToCcExtensions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cc_extensions', function($table){
            $table->string('rejection_note')->nullable()->after('granted_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_extensions', function($table){
            $table->dropColumn('rejection_note');
        });
    }
}
