<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalRecordRequest extends FormRequest
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
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'visit_date' => ['sometimes', 'required', 'date', 'before_or_equal:today'],
            'diagnosis' => ['sometimes', 'required', 'string'],
            'symptoms' => ['nullable', 'string'],
            'treatment' => ['nullable', 'string'],
            'prescription' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'visit_date.before_or_equal' => 'The visit date cannot be in the future.',
        ];
    }
}
