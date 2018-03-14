<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesApprovalNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_approval_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name')->nullable();
            $table->string('bandwidth_size')->nullable();
            $table->string('order_value')->nullable();
            $table->string('job_id')->nullable();
            $table->string('capex')->nullable();
            $table->string('opex')->nullable();
            $table->string('operator_involed')->nullable();
            $table->string('miscellaneous_expenses')->nullable();
            $table->string('comment')->nullable();
            $table->string('approved_by_hod')->nullable();
            $table->string('approved_by_ceo')->nullable();
            $table->string('approval_remark')->nullable();
            $table->string('generated_by')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_approval_notes');
    }
}
