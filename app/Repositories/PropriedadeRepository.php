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
        return $this->entity->with('contrato')->get();
    }

    public function createPropriedade(array $data) 
    {
        return $this->entity->create($data);
    }

    public function getPropriedadeByUuid(string $uuid, bool $loadContrato = true)
    {
        $q = $this->entity->newQuery();

        $q->where('uuid', $uuid);

        if ($loadContrato) 
            $q->with('contrato');
            
        return $q->firstOrFail();
    }

    public function deletePropriedadeByUuid(string $uuid)
    {
        $propriedade = $this->getPropriedadeByUuid($uuid, false);

        return $propriedade->delete();
    }

    public function updatePropriedadeByUuid(string $uuid, array $data)
    {
        $propriedade = $this->getPropriedadeByUuid($uuid, false);

        return $propriedade->update($data);
    }
}