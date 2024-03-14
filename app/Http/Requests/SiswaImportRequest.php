<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaImportRequest extends FormRequest
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
            'file' => [
                'required',
                'mimes:xlsx,xls',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File wajib diisi.',
            'file.mimes' => 'File wajib Extensi XLSX/CSV/XLS.',
        ];
    }
}
