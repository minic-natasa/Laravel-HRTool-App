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
            $table->string('name_of_one_parent');
            $table->date('birth_date')->nullable();
            $table->string('address_in_ID');
            $table->string('current_address');
            $table->string('slava');
            $table->string('private_email');
            $table->string('mobile');
            $table->string('bank_account_number');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            //$table->unsignedBigInteger('manager_id')->nullable();
            //$table->foreign('manager_id')->references('id')->on('users');
            $table->bigInteger('employee_number')->unique();
            $table->bigInteger('jmbg')->unique();
            $table->bigInteger('ID_number')->unique();
            $table->bigInteger('passport_number')->unique();
            $table->string('professional_qualifications_level');
            $table->string('profession');

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
                $table->dropColumn('family_member_id');
            });
        }
    }
};
