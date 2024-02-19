<?php

namespace App\Http\Requests;

use App\Rules\TokenAutenticateRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserDirectorRequest extends FormRequest
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
            'nome' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'keyauth' => ['required', new TokenAutenticateRule(env('TOKEN_AUTENTICATE_REGISTER'))]
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
            'nome.required' => 'Campo Nome Obrigatório',
            'email.required' => 'Campo E-mail Obrigatório',
            'email.email' => 'Formato do E-mail Inválido',
            'email.unique' => 'Este E-mail ja esta em Uso',
            'password.required' => 'Campo Password Obrigatório',
            'password.min' => 'Mínimo 8 Caracteres',
            'keyauth.required' => 'Chave de Autenticação Obrigatória',
        ];
    }
}
