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
        Schema::create('annexes', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
            $table->string('old_gross_salary')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('old_position')->nullable();
            $table->string('position')->nullable();
            $table->string('old_address_of_work')->nullable();
            $table->string('address_of_work')->nullable();
            $table->string('old_address_of_employer')->nullable();
            $table->string('address_of_employer')->nullable();
            $table->string('old_working_hours')->nullable();
            $table->string('working_hours')->nullable();
            $table->date('annex_date');
            $table->date('annex_created_date');
            $table->boolean('deleted')->default(0);
            $table->unsignedBigInteger('contract_id');
            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('contracts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annexes');
    }
};
