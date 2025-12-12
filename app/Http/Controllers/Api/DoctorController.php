<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Doctor::class);
        
        $doctors = Doctor::with(['appointments'])->paginate(15);
        return DoctorResource::collection($doctors);
    }

    public function store(StoreDoctorRequest $request)
    {
        $this->authorize('create', Doctor::class);
        
        $doctor = Doctor::create($request->validated());
        return new DoctorResource($doctor);
    }

    public function show(Doctor $doctor)
    {
        $this->authorize('view', $doctor);
        
        return new DoctorResource($doctor->load(['appointments', 'medicalRecords']));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);
        
        $doctor->update($request->validated());
        return new DoctorResource($doctor);
    }

    public function destroy(Doctor $doctor)
    {
        $this->authorize('delete', $doctor);
        
        $doctor->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
