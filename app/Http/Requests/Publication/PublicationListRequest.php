<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;

class PublicationListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
        ];
    }
}
