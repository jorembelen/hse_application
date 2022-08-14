<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRootCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('root_causes', function (Blueprint $table) {
            $table->id();
            $table->string('report_id');
            $table->uuid('user_id');
            $table->string('incident_id');
            $table->string('root_name');
            $table->string('type');
            $table->string('rec_name');
            $table->string('rec_type');
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('root_causes');
    }
}
