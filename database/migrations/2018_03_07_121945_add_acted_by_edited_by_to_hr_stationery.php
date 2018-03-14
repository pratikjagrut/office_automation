<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActedByEditedByToHrStationery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hr_stationaries', function($table){
            $table->string('acted_by')->nullable()->after('generated_by');
            $table->string('edited_by')->nullable()->after('acted_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_stationaries', function($table){
            $table->dropColumn('acted_by');
            $table->dropColumn('edited_by');
        });
    }
}
