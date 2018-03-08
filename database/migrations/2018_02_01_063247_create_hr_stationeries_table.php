<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrStationeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('hr_stationaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('hr_stationeries');
    }
}
