<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;

class PublicationCreateOrUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'release_id' => 'required|exists:releases,id',
            'authors' => 'required|string|min:1',
            'resume' => 'required|string|min:1',
            'abstract' => 'required|string|min:1',
            'keywords' => 'required|string|min:1',
            'pdf' => 'required|mimes:pdf',
        ];
    }
}
