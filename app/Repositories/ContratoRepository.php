<?php

namespace App\Repositories;

use App\Models\Contrato;

class ContratoRepository
{
    protected $entity;

    public function __construct(Contrato $c)
    {
        $this->entity = $c;
    }

    public function createContrato(array $data)
    {
        return $this->entity->create($data);
    }
}