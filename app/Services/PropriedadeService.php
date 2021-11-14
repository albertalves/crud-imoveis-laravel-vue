<?php

namespace App\Services;

use App\Repositories\PropriedadeRepository;

class PropriedadeService
{
    protected $propriedadeRepository;
    
    public function __construct(PropriedadeRepository $p)
    {
        $this->propriedadeRepository = $p;
    }

    public function getPropriedades()
    {
        return $this->propriedadeRepository->getAllPropriedades();
    }

    public function createPropriedade(array $data)
    {
        return $this->propriedadeRepository->createPropriedade($data);
    }

    public function getPropriedade(string $uuid)
    {
        return $this->propriedadeRepository->getPropriedadeByUuid($uuid);
    }

    public function deletePropriedade(string $uuid)
    {
        return $this->propriedadeRepository->deletePropriedadeByUuid($uuid);
    }

    public function updatePropriedade(string $uuid, array $data)
    {
        return $this->propriedadeRepository->updatePropriedadeByUuid($uuid, $data);
    }
}