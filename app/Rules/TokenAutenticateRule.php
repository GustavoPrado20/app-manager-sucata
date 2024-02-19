<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TokenAutenticateRule implements ValidationRule
{
    protected $Token;

    /**
     * Undocumented function
     */
    public function __construct(string $tokenKey)
    {
        $this->Token = $tokenKey;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value != $this->Token)
        {
            $fail(__('Chave de Autenticação Inválida', ['attribute' => $attribute]));
        }
        
    }

    public function message(): string
    {
        return __('Chave de Autenticação Inválida');
    }
}
