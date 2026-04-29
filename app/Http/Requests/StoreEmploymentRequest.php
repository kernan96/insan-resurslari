<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmploymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // mütləq true olmalıdır
    }

    public function rules(): array
    {
        return [
            'organization_id'   => 'required|exists:organization_departments,id',
            'user_id'           => 'required|exists:users,id',

            'contract_no'       => 'nullable|string|max:255',

            'emp_type_id'       => 'required|exists:employment_types,id',
            'org_position_id'  => 'required|exists:org_positions,id',

            'start_date'        => 'required|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',

            'salary'            => 'nullable|numeric|min:0',

            'note'              => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'organization_id.required' => 'Təşkilat seçilməlidir',
            'organization_id.exists'   => 'Təşkilat düzgün deyil',

            'user_id.required'         => 'İstifadəçi seçilməlidir',
            'user_id.exists'           => 'İstifadəçi düzgün deyil',

            'emp_type_id.required'     => 'İşçi tipi seçilməlidir',
            'emp_type_id.exists'       => 'İşçi tipi düzgün deyil',

            'org_position_id.required' => 'Vəzifə seçilməlidir',
            'org_position_id.exists'   => 'Vəzifə düzgün deyil',

            'start_date.required'      => 'Başlama tarixi mütləqdir',
            'start_date.date'          => 'Tarix formatı yanlışdır',

            'end_date.after_or_equal'  => 'Bitmə tarixi başlama tarixindən kiçik ola bilməz',

            'salary.numeric'           => 'Maaş rəqəm olmalıdır',
        ];
    }
}