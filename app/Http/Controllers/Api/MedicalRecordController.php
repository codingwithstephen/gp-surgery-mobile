<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['patient', 'doctor', 'appointment'])->paginate(15);
        return response()->json($records);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'visit_date' => 'required|date',
            'diagnosis' => 'required|string',
            'symptoms' => 'nullable|string',
            'treatment' => 'nullable|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $record = MedicalRecord::create($request->all());
        return response()->json($record->load(['patient', 'doctor', 'appointment']), Response::HTTP_CREATED);
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return response()->json($medicalRecord->load(['patient', 'doctor', 'appointment']));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'sometimes|required|exists:patients,id',
            'doctor_id' => 'sometimes|required|exists:doctors,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'visit_date' => 'sometimes|required|date',
            'diagnosis' => 'sometimes|required|string',
            'symptoms' => 'nullable|string',
            'treatment' => 'nullable|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $medicalRecord->update($request->all());
        return response()->json($medicalRecord->load(['patient', 'doctor', 'appointment']));
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
