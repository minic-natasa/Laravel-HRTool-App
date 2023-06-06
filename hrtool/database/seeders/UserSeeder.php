<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'first_name' => 'Marko',
            'last_name' => 'Marković',
            'email' => 'user@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role' => 'user',

            'manager' => '1',
            'name_of_one_parent' => 'Nikola',
            'birth_date' => '1993-01-11',
            'address_in_ID' => 'Dalmatinska 11, Beograd',
            'current_address' => 'Dalmatinska 11, Beograd',
            'slava' => 'Sv. Nikola',

            'private_email' => 'markom@gmail.com',
            'mobile' => '+38164755744',
            'bank_account_number' => '160-48575698-14',
            'emergency_contact_name' => 'Nikola Marković',
            'emergency_contact_number' => '+38165552552',
            'employee_number' => 123456,
            'jmbg' => 1101993727854,
            'ID_number' => 106547,
            'passport_number' => 110024,
            'professional_qualifications_level' => 'V',
            'profession' => 'Dipl. ekonomista',

        ]);
        $user->assignRole('user');
    }
}
