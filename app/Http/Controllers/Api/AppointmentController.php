<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->paginate(15);
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'duration_minutes' => 'sometimes|integer|min:15',
            'status' => 'sometimes|in:scheduled,confirmed,completed,cancelled',
            'reason' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $appointment = Appointment::create($request->all());
        return response()->json($appointment->load(['patient', 'doctor']), Response::HTTP_CREATED);
    }

    public function show(Appointment $appointment)
    {
        return response()->json($appointment->load(['patient', 'doctor', 'medicalRecord']));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'sometimes|required|exists:patients,id',
            'doctor_id' => 'sometimes|required|exists:doctors,id',
            'appointment_date' => 'sometimes|required|date',
            'duration_minutes' => 'sometimes|integer|min:15',
            'status' => 'sometimes|in:scheduled,confirmed,completed,cancelled',
            'reason' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $appointment->update($request->all());
        return response()->json($appointment->load(['patient', 'doctor']));
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
