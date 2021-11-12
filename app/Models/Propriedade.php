<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propriedade extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    public $timestamps = true;

    protected $fillable = [
        'email_proprietario',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado'
    ];
}


	