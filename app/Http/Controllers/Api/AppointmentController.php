<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Appointment::class);
        
        $appointments = Appointment::with(['patient', 'doctor'])->paginate(15);
        return AppointmentResource::collection($appointments);
    }

    public function store(StoreAppointmentRequest $request)
    {
        $this->authorize('create', Appointment::class);
        
        $appointment = Appointment::create($request->validated());
        return new AppointmentResource($appointment->load(['patient', 'doctor']));
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        
        return new AppointmentResource($appointment->load(['patient', 'doctor', 'medicalRecord']));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        
        $appointment->update($request->validated());
        return new AppointmentResource($appointment->load(['patient', 'doctor']));
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);
        
        $appointment->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
