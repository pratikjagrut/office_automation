<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrManpowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_manpowers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vacancy_designation')->nullable();
            $table->string('no_of_vacancy')->nullable();
            $table->string('reason')->nullable();
            $table->string('priority')->nullable();
            $table->string('preferences')->nullable();
            $table->string('qualification')->nullable();
            $table->string('status')->nullable();
            $table->string('comment')->nullable();
            $table->text('job_description')->nullable();
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
        Schema::dropIfExists('hr_manpowers');
    }
}
