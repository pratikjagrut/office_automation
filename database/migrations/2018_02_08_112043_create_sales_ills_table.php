<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesIllsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_ills', function (Blueprint $table) {
            $table->increments('id');
             $table->string('customer_name')->nullable();
             $table->string('customer_address')->nullable();
             $table->string('customer_city')->nullable();
             $table->string('customer_state')->nullable();
             $table->string('pincode')->nullable();
             $table->string('contact_person_name')->nullable();
             $table->string('contact_person_no')->nullable();
             $table->string('contact_person_email')->nullable();
             $table->string('bandwidth_size')->nullable();
             $table->string('feasibility_status')->nullable();
             $table->string('fiber')->nullable();
             $table->string('rf')->nullable();
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
        Schema::dropIfExists('sales_ills');
    }
}
