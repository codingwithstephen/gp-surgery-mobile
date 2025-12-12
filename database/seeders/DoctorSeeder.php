<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@gpsurgery.com',
                'phone' => '020 1234 5678',
                'specialization' => 'General Practice',
                'license_number' => 'GMC12345',
                'qualifications' => 'MBBS, MRCGP',
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Smith',
                'email' => 'james.smith@gpsurgery.com',
                'phone' => '020 1234 5679',
                'specialization' => 'General Practice',
                'license_number' => 'GMC12346',
                'qualifications' => 'MBBS, MRCGP, DRCOG',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Williams',
                'email' => 'emily.williams@gpsurgery.com',
                'phone' => '020 1234 5680',
                'specialization' => 'Pediatrics',
                'license_number' => 'GMC12347',
                'qualifications' => 'MBBS, MRCPCH',
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
