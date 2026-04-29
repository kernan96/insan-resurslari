<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $userId = $this->input('user_id');
        return [
            // Şəxsi məlumatlar
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'fin' => 'required|string|size:7|unique:users,fin,' . $userId,
            'serial_no' => 'nullable|string|max:50',
            'profile_photo_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'birth_date' => 'nullable|date|before:today',
            'birth_place' => 'nullable|string|max:255',
            'citizen' => 'nullable|string|max:100',
            'gender' => 'required|in:0,1',
            'marital_status' => 'nullable|in:0,1',
            // İş məlumatları
            'org_position_id' => 'required|exists:org_positions,id',
            'emp_type_id' => 'required|exists:employment_types,id',
            'salary' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_no' => 'nullable|string|max:100',
            'sin' => 'nullable|string|max:50',
            // Sistem giriş
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'email' => 'nullable|email|max:255|unique:users,email,' . $userId,
            'role_id' => 'required|exists:roles,id',
            // 🔥 fərq burdadır
            'password' => 'nullable|string|min:8',
            // Ünvan
            'registered_address' => 'nullable|string|max:500',
            'residential_address' => 'nullable|string|max:500',
            // əlavə
            'employment_id' => 'required|exists:user_employments,id',
        ];
    }
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
            'profile_photo_path.mimes' => 'Profil şəkli JPG, JPEG və ya PNG olmalıdır.',
            'profile_photo_path.max' => 'Profil şəkli maksimum 2MB ola bilər.',
            'birth_date.before' => 'Doğum tarixi bugündən əvvəl olmalıdır.',
            'gender.required' => 'Cinsiyyət seçilməlidir.',
            'org_position_id.required' => 'Vəzifə seçilməlidir.',
            'emp_type_id.required' => 'İşçi tipi seçilməlidir.',
            'start_date.required' => 'Başlama tarixi boş ola bilməz.',
            'end_date.after_or_equal' => 'Bitmə tarixi səhvdir.',
            'username.required' => 'İstifadəçi adı boş ola bilməz.',
            'username.unique' => 'Bu username artıq mövcuddur.',
            'email.email' => 'E-poçt düzgün deyil.',
            'email.unique' => 'Bu e-poçt artıq mövcuddur.',
            'role_id.required' => 'Rol seçilməlidir.',
            'password.min' => 'Şifrə minimum 8 simvol olmalıdır.',
            'employment_id.required' => 'Employment tapılmadı.',
        ];
    }
}