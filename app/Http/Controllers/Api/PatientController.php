<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Patient::class);
        
        $patients = Patient::with(['appointments', 'medicalRecords'])->paginate(15);
        return PatientResource::collection($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $this->authorize('create', Patient::class);
        
        $patient = Patient::create($request->validated());
        return new PatientResource($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);
        
        return new PatientResource($patient->load(['appointments', 'medicalRecords']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        
        $patient->update($request->validated());
        return new PatientResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $this->authorize('delete', $patient);
        
        $patient->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
