<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserDirectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function messages()
    {
        return [
            'email.required' => 'Campo E-mail Obrigatório',
            'email.email' => 'Formato do E-mail Inválido',
            'password.required' => 'Campo Password Obrigatório'
        ];
    }
}
