<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('incident_id');
            $table->unsignedInteger('employee_id');
            $table->uuid('user_id');
            $table->unsignedInteger('location_id');
            $table->string('safety')->nullable();
            $table->string('proof_training')->nullable();
            $table->string('mgr_name');
            $table->string('sup_name')->nullable();
            $table->string('inc_loc');
            $table->string('nature');
            $table->string('other');
            $table->text('description');
            $table->text('details');
            $table->string('aid');
            $table->unsignedInteger('aider')->nullable();
            $table->string('hosp');
            $table->string('hospital')->nullable();
            $table->string('hos_addr')->nullable();
            $table->string('med_leave');
            $table->integer('leave_days')->nullable();
            $table->string('prop_dam');
            $table->string('est_dam')->nullable();
            $table->string('est_amt')->nullable();
            $table->string('property')->nullable();
            $table->string('prop_loc')->nullable();
            $table->string('prop_manuf')->nullable();
            $table->string('prop_model')->nullable();
            $table->string('prop_plate')->nullable();
            $table->string('prop_reg')->nullable();
            $table->string('prop_rte')->nullable();
            $table->string('toolbox');
            $table->string('ppe');
            $table->string('ppe_equip')->nullable();
            $table->string('emp_doing');
            $table->string('emp_machine');
            $table->string('emp_material');
            $table->text('imm_cause');
            $table->boolean('remarks')->default('0');
            $table->string('witness');
            $table->string('wit_type')->nullable();
            $table->string('wit_details')->nullable();
            $table->text('wit_statement')->nullable();
            $table->string('proof')->nullable();
            $table->string('inc_img')->nullable();
            $table->string('docs')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
