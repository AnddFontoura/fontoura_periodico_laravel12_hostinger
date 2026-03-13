<?php

namespace App\Http\Requests\Release;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
