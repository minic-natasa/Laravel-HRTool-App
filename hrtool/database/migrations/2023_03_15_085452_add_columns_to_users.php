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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name_of_one_parent')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address_in_ID')->nullable();
            $table->string('current_address')->nullable();
            $table->string('slava')->nullable();
            $table->string('private_email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            //$table->unsignedBigInteger('manager_id')->nullable();
            //$table->foreign('manager_id')->references('id')->on('users');
            $table->bigInteger('employee_number')->unique()->nullable();
            $table->bigInteger('jmbg')->unique()->nullable();
            $table->bigInteger('ID_number')->unique()->nullable();
            $table->bigInteger('passport_number')->unique()->nullable();
            $table->string('professional_qualifications_level')->nullable();
            $table->string('profession')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('profile_picture')->nullable(); 

            /*
            DB::table('users')
                ->where('birth_date', '0000-00-00')
                ->update(['birth_date' => '1900-01-01']);


            Schema::table('users', function (Blueprint $table) {
                $table->date('birth_date')->nullable(false)->change();
            });
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('first_name');
                $table->dropColumn('last_name');
                $table->dropColumn('name_of_one_parent');
                $table->dropColumn('birth_date');
                $table->dropColumn('address_in_ID');
                $table->dropColumn('current_address');
                $table->dropColumn('slava');
                $table->dropColumn('private_email');
                $table->dropColumn('mobile');
                $table->dropColumn('bank_account_number');
                $table->dropColumn('emergency_contact_name');
                $table->dropColumn('emergency_contact_number');
                $table->dropColumn('professional_qualifications_level');
                $table->dropColumn('profession');
                //$table->dropColumn('manager_id');
                $table->dropColumn('employee_number');
                $table->dropColumn('jmbg');
                $table->dropColumn('ID_number');
                $table->dropColumn('passport_number');
                $table->dropColumn('status');
            });
        }
    }
};
