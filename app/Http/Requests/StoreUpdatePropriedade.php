<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePropriedade extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email_proprietario' => 'required|email:rfc,dns',
            'rua'                => 'required',
            'numero'             => 'nullable',
            'complemento'        => 'nullable',
            'bairro'             => 'required',
            'cidade'             => 'required',
            'estado'             => 'required',
        ];
    }

    public function messages()
    {
        $message = "Campo de preenchimento obrigatório";

        return [
            'email_proprietario.required'       => $message,
            'email_proprietario.email'          => "Informe um e-mail válido.",
            'rua.required'                      => $message,
            'bairro.required'                   => $message,
            'cidade.required'                   => $message,
            'estado.required'                   => $message,
        ];
    }
}
