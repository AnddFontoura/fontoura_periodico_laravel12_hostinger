<?php

namespace App\Http\Requests\Release;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseCreateOrUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'publication_id' => 'required|exists:publications,id',
        ];
    }
}
