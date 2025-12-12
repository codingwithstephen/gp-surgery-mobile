<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicalRecordRequest;
use App\Http\Requests\UpdateMedicalRecordRequest;
use App\Http\Resources\MedicalRecordResource;
use App\Models\MedicalRecord;
use Illuminate\Http\Response;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', MedicalRecord::class);
        
        $records = MedicalRecord::with(['patient', 'doctor', 'appointment'])->paginate(15);
        return MedicalRecordResource::collection($records);
    }

    public function store(StoreMedicalRecordRequest $request)
    {
        $this->authorize('create', MedicalRecord::class);
        
        $record = MedicalRecord::create($request->validated());
        return new MedicalRecordResource($record->load(['patient', 'doctor', 'appointment']));
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $this->authorize('view', $medicalRecord);
        
        return new MedicalRecordResource($medicalRecord->load(['patient', 'doctor', 'appointment']));
    }

    public function update(UpdateMedicalRecordRequest $request, MedicalRecord $medicalRecord)
    {
        $this->authorize('update', $medicalRecord);
        
        $medicalRecord->update($request->validated());
        return new MedicalRecordResource($medicalRecord->load(['patient', 'doctor', 'appointment']));
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $this->authorize('delete', $medicalRecord);
        
        $medicalRecord->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
