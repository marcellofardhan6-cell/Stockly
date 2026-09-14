<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ($this->session()->get('auth_user')['role'] ?? null) === 'admin';
    }

    public function rules(): array
    {
        $supplierId = $this->route('supplier')?->id;

        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('supplier', 'nama')->ignore($supplierId),
            ],
            'kontak' => ['nullable', 'string', 'max:100'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:100'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama supplier',
            'kontak' => 'Kontak',
            'telepon' => 'Telepon',
            'email' => 'Email',
            'alamat' => 'Alamat',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
