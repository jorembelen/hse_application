<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->unsignedInteger('employee_id');
            $table->string('sel_involved');
            $table->string('involved');
            $table->string('type');
            $table->string('inc_category');
            $table->string('insurance');
            $table->string('wps');
            $table->string('severity');
            $table->string('injury_location')->nullable();
            $table->string('injury_sustain')->nullable();
            $table->string('cause')->nullable();
            $table->string('equipment')->nullable();
            $table->text('description');
            $table->text('action');
            $table->boolean('status')->default('0');
            $table->string('docs')->nullable();
            $table->unsignedInteger('location');
            $table->dateTime('date', 0);
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
        Schema::dropIfExists('incidents');
    }
}
