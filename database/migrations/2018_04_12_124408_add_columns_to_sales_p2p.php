<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSalesP2p extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_p2ps', function($table){
            $table->string('job_id')->nullable()->after('id');
            $table->text('other_requirments')->nullable()->after('network_priority');
            $table->string('feasibility_checked_by')->nullable()->after('bts_address');
            $table->string('forward_to_ceo')->nullable()->after('feasibility_checked_by');
            $table->string('forwarded_by')->nullable()->after('forward_to_ceo');
            $table->text('comment')->nullable()->after('forwarded_by');
            $table->string('approval')->nullable()->after('comment');
            $table->text('approval_note')->nullable()->after('approval');
            $table->string('approved_by')->nullable()->after('approval_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_p2ps', function($table){
            $table->dropColumn('job_id');
            $table->dropColumn('other_requirments');
            $table->dropColumn('feasibility_checked_by');
            $table->dropColumn('forward_to_ceo');
            $table->dropColumn('forwarded_by');
            $table->dropColumn('comment');
            $table->dropColumn('approval');
            $table->dropColumn('approval_note');
            $table->dropColumn('approved_by');

        });
    }
}
