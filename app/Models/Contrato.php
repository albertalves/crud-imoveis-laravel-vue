<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'propriedade_id',
        'tipo_pessoa',
        'documento',
        'email',
        'nome_completo'
    ];

}
