<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = [
            [
                'patient_id' => 1,
                'doctor_id' => 1,
                'appointment_date' => Carbon::now()->addDays(2)->setTime(10, 0),
                'duration_minutes' => 30,
                'status' => 'scheduled',
                'reason' => 'Routine checkup',
                'notes' => null,
            ],
            [
                'patient_id' => 2,
                'doctor_id' => 3,
                'appointment_date' => Carbon::now()->addDays(3)->setTime(14, 30),
                'duration_minutes' => 45,
                'status' => 'confirmed',
                'reason' => 'Asthma review',
                'notes' => 'Patient requested longer appointment',
            ],
            [
                'patient_id' => 3,
                'doctor_id' => 2,
                'appointment_date' => Carbon::now()->addDays(5)->setTime(11, 15),
                'duration_minutes' => 30,
                'status' => 'scheduled',
                'reason' => 'Diabetes management',
                'notes' => null,
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
