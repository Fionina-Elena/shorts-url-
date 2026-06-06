<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => 'Поле url обязательно для заполнения.',
            'url.url' => 'Url должен быть валидной HTTP или HTTPS ссылкой.',
        ];
    }
}
