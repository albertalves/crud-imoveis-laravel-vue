<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContrato extends FormRequest
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
        $count = strlen(preg_replace('/[^0-9]/', '', $this->documento));
        $tipo = ($count == 11) ? 'cpf|formato_cpf' : 'cnpj|formato_cnpj';

        return [
            'propriedade_id'             => 'required|unique:contratos',
            'tipo_pessoa'                => 'required',
            'documento'                  => "required|{$tipo}",
            'email_contratante'          => 'required|email:rfc,dns',
            'nome_completo_contratante'  => 'required'
        ];
    }

    public function messages()
    {
        $message = "Campo de preenchimento obrigatório";

        return [
            'propriedade_id.required'               => $message,
            'propriedade_id.unique'                 => 'Esta propriedade já está vinculada a um contrato.',
            'tipo_pessoa.required'                  => $message,
            'documento.required'                    => $message,
            'email_contratante.required'            => $message,
            'email_contratante.email'               => "Informe um e-mail válido.",
            'nome_completo_contratante.required'    => $message,
        ];
    }
}
