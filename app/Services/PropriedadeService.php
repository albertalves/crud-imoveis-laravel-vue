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

    public function createPropriedade(array $data){
        return $this->propriedadeRepository->createPropriedade($data);
    }
}