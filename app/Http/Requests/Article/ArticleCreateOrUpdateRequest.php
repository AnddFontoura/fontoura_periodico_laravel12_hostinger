<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateOrUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // On update the route provides an {id}; the PDF is only mandatory when creating.
        $isUpdate = $this->route('id') !== null;

        return [
            'name' => 'required|string|max:255',
            'release_id' => 'required|exists:releases,id',
            'authors' => 'required|string|min:1',
            'resume' => 'required|string|min:1',
            'abstract' => 'required|string|min:1',
            'keywords' => 'required|string|min:1',
            'pdf' => ($isUpdate ? 'nullable' : 'required') . '|mimes:pdf',
        ];
    }
}
