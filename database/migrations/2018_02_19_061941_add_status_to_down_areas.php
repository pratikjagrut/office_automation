<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToDownAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cc_down_areas', function($table){
            $table->string('status')->default('down')->after('generated_by');
            $table->string('closed_by')->nullable()->after('status');
            $table->string('tat')->nullable()->after('up_day_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_down_areas', function($table){
            $table->dropColumn('status');
            $table->dropColumn('closed_by');
            $table->dropColumn('tat');
        });
    }
}
