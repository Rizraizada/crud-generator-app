<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {{ modelName }}StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Validation rules for storing records
        ];
    }
}
