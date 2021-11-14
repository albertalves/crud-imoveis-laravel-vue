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
        $tipo = $this->tipo_pessoa == 'f' ? 'cpf|formato_cpf' : 'cnpj|formato_cnpj';

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
        $message = "O campo :attribute é obrigatório";

        return [
            'propriedade_id.required'               => $message,
            'propriedade_id.unique'                 => 'Já existe uma propriedade com este contrato.',
            'tipo_pessoa.required'                  => $message,
            'documento.required'                    => $message,
            'email_contratante.required'            => $message,
            'email_contratante.email'               => "Informe um e-mail válido.",
            'nome_completo_contratante.required'    => $message,
        ];
    }
}
