<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('file_path')->nullable();
            $table->string('remark')->nullable();
            $table->string('level1_approval')->nullable();
            $table->string('level2_approval')->nullable();
            $table->string('level3_approval')->nullable();
            $table->string('job_id')->nullable();
            $table->string('priority')->nullable();
            $table->string('deadline')->nullable();
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
        Schema::dropIfExists('document_approvals');
    }
}
