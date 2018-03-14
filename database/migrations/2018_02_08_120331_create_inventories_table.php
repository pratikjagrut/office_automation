<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_name')->nullable();
            $table->string('vendor_address')->nullable();
            $table->string('vendor_email')->nullable();
            $table->string('date')->nullable();
            $table->string('purchase_order_no')->nullable();
            $table->string('from_dept')->nullable();
            $table->string('purchase_requisition_no')->nullable();
            $table->string('quotation_dept')->nullable();
            $table->string('quotation_reference_no')->nullable();
            $table->string('ship_to')->nullable();
            $table->string('good_description')->nullable();
            $table->string('unit')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('amount')->nullable();
            $table->string('total_rs')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('validity_of_purchase_order')->nullable();
            $table->string('date_of_expiry')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
