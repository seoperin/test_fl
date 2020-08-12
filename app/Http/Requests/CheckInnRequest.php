<?php

namespace App\Http\Requests;

use App\Rules\Inn;
use Illuminate\Foundation\Http\FormRequest;

class CheckInnRequest extends FormRequest
{
    public function rules()
    {
        return [
            'inn' => ['bail', 'required', new Inn],
        ];
    }

    public function messages()
    {
        return [
            'inn.required' => 'Введите ИНН',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
