<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '07700 900123',
                'date_of_birth' => '1985-05-15',
                'gender' => 'male',
                'address' => '123 High Street, London, SW1A 1AA',
                'nhs_number' => '4505577104',
                'medical_history' => 'Hypertension diagnosed in 2019',
                'allergies' => 'Penicillin',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '07700 900124',
                'date_of_birth' => '1990-08-22',
                'gender' => 'female',
                'address' => '456 Park Avenue, Manchester, M1 1AA',
                'nhs_number' => '4505577105',
                'medical_history' => 'Asthma',
                'allergies' => 'None',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@example.com',
                'phone' => '07700 900125',
                'date_of_birth' => '1978-12-03',
                'gender' => 'male',
                'address' => '789 Queen Street, Birmingham, B1 1AA',
                'nhs_number' => '4505577106',
                'medical_history' => 'Type 2 Diabetes',
                'allergies' => 'None',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
