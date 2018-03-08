<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dates_manually')->nullable();
            $table->string('destination')->nullable();
            $table->string('country_code')->nullable();
            $table->string('area_code')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('voips');
    }
}
