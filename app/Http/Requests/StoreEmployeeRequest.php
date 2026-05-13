<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $userId = $this->route('id') ?? $this->input('id');
        // Əgər fin göndərilibsə və həmin fin-ə aid user varsa, onun id-sini götür
        if ($this->input('fin')) {
            $existingUser = \App\Models\Structure\User::where('fin', $this->input('fin'))->first();
            if ($existingUser) {
                $userId = $existingUser->id;
            }
        }
        return [
            // Şəxsi məlumatlar
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'fin' => 'required|string|size:7', // unique qaydasını çıxardırıq
            'serial_no' => 'nullable|string|max:50',
            'profile_photo_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'birth_date' => 'nullable|date|before:today',
            'birth_place' => 'nullable|string|max:255',
            'citizen' => 'nullable|string|max:100',
            'gender' => 'required|in:0,1',
            'marital_status' => 'nullable|in:0,1',
            // İş və təşkilat məlumatları
            'org_position_id' => 'required|exists:org_positions,id',
            'emp_type_id' => 'required|exists:employment_types,id',
            'salary' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_no' => 'nullable|string|max:100',
            'sin' => 'nullable|string|max:50',
            // Sistem giriş məlumatları
            'username' => 'required|string|max:255|unique:users,username,' . ($userId ?? 'NULL'),
            'email' => 'nullable|email|max:255|unique:users,email,' . ($userId ?? 'NULL'),
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8',
            // Ünvan məlumatları
            'registered_address' => 'nullable|string|max:500',
            'residential_address' => 'nullable|string|max:500',
        ];
    }
    /**
     * Validation xətası baş verdikdə JSON response qaytar
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation xətası',
            'errors' => $validator->errors()
        ], 422));
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Ad sahəsi boş ola bilməz.',
            'last_name.required' => 'Soyad sahəsi boş ola bilməz.',
            'father_name.required' => 'Ata adı sahəsi boş ola bilməz.',
            'fin.required' => 'FİN sahəsi boş ola bilməz.',
            'fin.size' => 'FİN 7 simvoldan ibarət olmalıdır.',
            'fin.unique' => 'Bu FİN artıq sistemdə mövcuddur.',
            'profile_photo_path.mimes' => 'Profil şəkli JPG, JPEG və ya PNG formatında olmalıdır.',
            'profile_photo_path.max' => 'Profil şəkli maksimum 2MB ola bilər.',
            'birth_date.before' => 'Doğum tarixi bugündən əvvəl olmalıdır.',
            'gender.required' => 'Cinsiyyət sahəsi boş ola bilməz.',
            'org_position_id.required' => 'Vəzifə sahəsi boş ola bilməz.',
            'emp_type_id.required' => 'İşçi tipi sahəsi boş ola bilməz.',
            'start_date.required' => 'Başlama tarixi boş ola bilməz.',
            'end_date.after_or_equal' => 'Bitmə tarixi başlama tarixindən əvvəl ola bilməz.',
            'username.required' => 'İstifadəçi adı sahəsi boş ola bilməz.',
            'username.unique' => 'Bu istifadəçi adı artıq mövcuddur.',
            'email.email' => 'E-poçt düzgün formatda deyil.',
            'email.unique' => 'Bu e-poçt artıq mövcuddur.',
            'role_id.required' => 'Rol sahəsi boş ola bilməz.',
            'password.required' => 'Şifrə sahəsi boş ola bilməz.',
            'password.min' => 'Şifrə minimum 6 simvoldan ibarət olmalıdır.',
        ];
    }
}
