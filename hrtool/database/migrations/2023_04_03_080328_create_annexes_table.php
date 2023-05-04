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
            $table->string('reason');
            $table->string('old_value');
            $table->string('new_value');
            $table->date('annex_date');
            $table->date('annex_created_date');
            $table->boolean('deleted');
            $table->timestamps();
            $table->unsignedBigInteger('contract_id');
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
