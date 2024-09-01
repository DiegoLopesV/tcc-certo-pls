<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:3',
            'cpf' => 'required|min:3',
            'nome_pais' => 'required|min:3',
            'telefone' => 'required|min:3',
            'telefone_pais' => 'required|min:3',
            'email' => 'required|min:3',
            'email_pais' => 'required|min:3',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
