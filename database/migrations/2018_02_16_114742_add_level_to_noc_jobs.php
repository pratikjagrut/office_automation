<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelToNocJobs extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_jobs', function($table){
            $table->integer('assigned_to_level')->nullable()->after('assign_to');
            $table->string('transferred_to_level')->nullable()->after('assigned_to_level');
            $table->string('transferred_to')->nullable()->after('transferred_to_level');
            $table->string('transferred_by')->nullable()->after('transferred_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_jobs', function($table){
            $table->dropColumn('assigned_to_level');
            $table->dropColumn('transferred_to_level');
            $table->dropColumn('transferred_to');
            $table->dropColumn('transferred_by');
        });
    }
}
