<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCcDownAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_down_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('reason')->nullable();
            $table->string('down_day_time')->nullable();
            $table->string('up_day_time')->nullable();
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
        Schema::dropIfExists('cc_down_areas');
    }
}
