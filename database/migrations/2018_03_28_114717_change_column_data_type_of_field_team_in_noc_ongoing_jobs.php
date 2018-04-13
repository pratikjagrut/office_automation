<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnDataTypeOfFieldTeamInNocOngoingJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_ongoing_jobs', function ($table) {
            $table->string('assigned_to_level')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_ongoing_jobs', function($table){
            $table->dropColumn('assigned_to_level');
        });
    }
}
