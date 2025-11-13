<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['appointments'])->paginate(15);
        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'license_number' => 'required|string|unique:doctors,license_number',
            'qualifications' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $doctor = Doctor::create($request->all());
        return response()->json($doctor, Response::HTTP_CREATED);
    }

    public function show(Doctor $doctor)
    {
        return response()->json($doctor->load(['appointments', 'medicalRecords']));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'sometimes|required|string|max:20',
            'specialization' => 'sometimes|required|string|max:255',
            'license_number' => 'sometimes|required|string|unique:doctors,license_number,' . $doctor->id,
            'qualifications' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $doctor->update($request->all());
        return response()->json($doctor);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
