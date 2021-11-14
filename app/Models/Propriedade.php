<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propriedade extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at']; // não retornar estas colunas na listagem
    public $timestamps = true;

    protected $fillable = [
        'email_proprietario',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'status'
    ];

    public function contrato()
    {
        return $this->hasOne(Contrato::class);
    }
}


	