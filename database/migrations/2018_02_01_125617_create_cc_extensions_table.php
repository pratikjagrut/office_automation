<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCcExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_extensions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id')->nullable();
            $table->string('complaint_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('generated_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('extension_day')->nullable();
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
        Schema::dropIfExists('cc_extensions');
    }
}
