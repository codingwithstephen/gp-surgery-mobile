<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'required', 'exists:patients,id'],
            'doctor_id' => ['sometimes', 'required', 'exists:doctors,id'],
            'appointment_date' => ['sometimes', 'required', 'date'],
            'duration_minutes' => ['sometimes', 'integer', 'min:15', 'max:180'],
            'status' => ['sometimes', 'in:scheduled,confirmed,completed,cancelled'],
            'reason' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
