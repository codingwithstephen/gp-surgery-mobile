<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with(['appointments', 'medicalRecords'])->paginate(15);
        return response()->json($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'address' => 'nullable|string',
            'nhs_number' => 'required|string|unique:patients,nhs_number',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $patient = Patient::create($request->all());
        return response()->json($patient, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return response()->json($patient->load(['appointments', 'medicalRecords']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:patients,email,' . $patient->id,
            'phone' => 'sometimes|required|string|max:20',
            'date_of_birth' => 'sometimes|required|date',
            'gender' => 'sometimes|required|string|in:male,female,other',
            'address' => 'nullable|string',
            'nhs_number' => 'sometimes|required|string|unique:patients,nhs_number,' . $patient->id,
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $patient->update($request->all());
        return response()->json($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
