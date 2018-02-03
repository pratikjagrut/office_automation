<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCcFeasibleAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_feasible_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reseller_name')->nullable();
            $table->string('building')->nullable();
            $table->string('society')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('switch location')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_number')->nullable();
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
        Schema::dropIfExists('cc_feasible_areas');
    }
}
