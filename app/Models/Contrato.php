<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at']; // não retornar estas colunas na listagem
    protected $fillable = ['propriedade_id', 'tipo_pessoa', 'documento', 'email_contratante', 'nome_completo_contratante'];

}
