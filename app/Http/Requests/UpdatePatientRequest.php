<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
        $patientId = $this->route('patient');
        
        return [
            'first_name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'unique:patients,email,' . $patientId],
            'phone' => ['sometimes', 'required', 'string', 'regex:/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/'],
            'date_of_birth' => ['sometimes', 'required', 'date', 'before:today'],
            'gender' => ['sometimes', 'required', 'string', 'in:male,female,other'],
            'address' => ['nullable', 'string'],
            'nhs_number' => ['sometimes', 'required', 'string', 'regex:/^\d{10}$/', 'unique:patients,nhs_number,' . $patientId],
            'medical_history' => ['nullable', 'string'],
            'allergies' => ['nullable', 'string'],
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
            'phone.regex' => 'The phone number must be a valid UK mobile number (e.g., 07700 900123).',
            'nhs_number.regex' => 'The NHS number must be exactly 10 digits.',
            'date_of_birth.before' => 'The date of birth must be in the past.',
        ];
    }
}
