<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('start_date');
            $table->date('first_day_on_job');
            $table->string('position');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('employee_number');
            $table->string('type_of_contract');
            $table->string('contract_number');
            $table->string('contract_duration');
            $table->tinyInteger('probationary_period');
            $table->float('net_salary');
            $table->float('gross_salary_1');
            $table->float('gross_salary_2');
            $table->string('location_of_work');
            $table->string('transportation');
            $table->string('status');

            $table->foreign('employee_number')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
