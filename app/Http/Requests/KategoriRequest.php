<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ($this->session()->get('auth_user')['role'] ?? null) === 'admin';
    }

    public function rules(): array
    {
        $kategoriId = $this->route('kategori')?->id;

        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori', 'nama')->ignore($kategoriId),
            ],
            'category_code' => [
                'required',
                'string',
                'alpha_num',
                'max:5',
                Rule::unique('kategori', 'category_code')->ignore($kategoriId),
            ],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('category_code')) {
            $this->merge(['category_code' => strtoupper($this->input('category_code'))]);
        }
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama kategori',
            'category_code' => 'Kode kategori',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
