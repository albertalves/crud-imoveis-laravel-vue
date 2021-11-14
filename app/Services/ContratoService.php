<?php

namespace App\Services;

use App\Repositories\ContratoRepository;

class ContratoService
{
    protected $contratoRepository;

    public function __construct(ContratoRepository $c)
    {
        $this->contratoRepository = $c;
    }

    public function createContrato(array $data)
    {
        return $this->contratoRepository->createContrato($data);
    }
}