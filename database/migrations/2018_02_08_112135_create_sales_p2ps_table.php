<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesP2psTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_p2ps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_no')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('a_end_address')->nullable();
            $table->string('a_end_city')->nullable();
            $table->string('a_end_state')->nullable();
            $table->string('a_end_pincode')->nullable();
            $table->string('a_end_lat_long')->nullable();
            $table->string('b_end_address')->nullable();
            $table->string('b_end_city')->nullable();
            $table->string('b_end_state')->nullable();
            $table->string('b_end_pincode')->nullable();
            $table->string('b_end_lat_long')->nullable();
            $table->string('network_priority')->nullable();
            $table->string('feasibility_status')->nullable();
            $table->string('a_end_feasibility')->nullable();
            $table->string('b_end_feasibility')->nullable();
            $table->string('bts_address')->nullable();
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
        Schema::dropIfExists('sales_p2ps');
    }
}
