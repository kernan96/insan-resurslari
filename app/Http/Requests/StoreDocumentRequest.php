<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
class StoreDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
        ];
        // Bütün document_types cədvəlini götürürük
        $documentTypes = \App\Models\Staff\DocumentType::all();
        foreach ($documentTypes as $docType) {
            if ($docType->is_multiple) {
                $rules[$docType->input_name . '.*'] = 'nullable|file|mimes:pdf|max:400';
                $rules[$docType->input_name] = 'nullable|array';
            } else {
                $rules[$docType->input_name] = 'nullable|file|mimes:pdf|max:400';
            }
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'user_id.required' => 'Əməkdaş seçilməyib.',
            'user_id.exists' => 'Seçilən əməkdaş tapılmadı.',
            // 'qurum_id.required' => 'Qurum seçilməyib.',
            // 'qurum_id.exists' => 'Seçilən qurum tapılmadı.',
            '*.mimes' => 'Yalnız PDF faylları qəbul olunur.',
            '*.max' => 'Fayl ölçüsü maksimum 400KB ola bilər.',
            '*.file' => 'Etibarsız fayl formatı.',
        ];
    }
    public function validateJson(array $data)
    {
        $validator = \Validator::make($data, $this->rules(), $this->messages());
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        return response()->json(['success' => true]);
    }
}
