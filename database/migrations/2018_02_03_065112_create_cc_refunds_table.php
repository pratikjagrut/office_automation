<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCcRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('cc_refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_no')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('reason')->nullable();
            $table->string('refund_amount')->nullable();
            $table->string('mail_date')->nullable();
            $table->string('refund_status')->nullable();
            $table->string('done_date')->nullable();
            $table->string('utr_no')->nullable();
            $table->string('assigned_to')->nullable();
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
        Schema::dropIfExists('cc_refunds');
    }
}
