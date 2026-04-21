<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255', 'regex:/^[^\x01-\x7E]+$/u'],
            'name_kana' => ['nullable', 'string', 'max:255', 'regex:/^[ァ-ヴー　]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_kanji.regex' => '名前（漢字）は全角文字で入力してください。',
            'name_kana.regex' => '名前（カナ）は全角カタカナで入力してください。',
        ];
    }

}