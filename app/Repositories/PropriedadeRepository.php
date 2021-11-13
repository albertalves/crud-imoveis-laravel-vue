<?php

namespace App\Repositories;

use App\Models\Propriedade;

class PropriedadeRepository
{
    protected $entity;

    public function __construct(Propriedade $p)
    {
        $this->entity = $p;
    }

    public function getAllPropriedades()
    {
        return $this->entity->get();
    }

    public function createPropriedade(array $data) {
        return $this->entity->create($data);
    }
}