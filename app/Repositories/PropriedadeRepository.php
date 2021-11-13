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

    public function getPropriedadeByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->firstOrFail();
    }

    public function deletePropriedadeByUuid(string $uuid)
    {
        $propriedade = $this->getPropriedadeByUuid($uuid);

        return $propriedade->delete();
    }

    public function updatePropriedadeByUuid(string $uuid, array $data)
    {
        $propriedade = $this->getPropriedadeByUuid($uuid);

        return $propriedade->update($data);
    }
}