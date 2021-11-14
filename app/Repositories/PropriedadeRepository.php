<?php

namespace App\Repositories;

use App\Models\Propriedade;
use Illuminate\Support\Facades\Cache;

class PropriedadeRepository
{
    protected $entity;

    public function __construct(Propriedade $p)
    {
        $this->entity = $p;
    }

    public function getAllPropriedades()
    {   
        return Cache::rememberForever('propriedades', function() {
            return $this->entity->with('contrato')->get();
        });
    }

    public function createPropriedade(array $data) 
    {
        Cache::forget('propriedades');

        return $this->entity->create($data);
    }

    public function getPropriedadeByUuid(string $uuid, bool $loadContrato = true)
    {
        $query = $this->entity->where('uuid', $uuid);

        if ($loadContrato) 
            $query->with('contrato');
            
        return $query->firstOrFail();
    }

    public function deletePropriedadeByUuid(string $uuid)
    {
        Cache::forget('propriedades');

        $propriedade = $this->getPropriedadeByUuid($uuid, false);

        return $propriedade->delete();
    }

    public function updatePropriedadeByUuid(string $uuid, array $data)
    {
        Cache::forget('propriedades');
        
        $propriedade = $this->getPropriedadeByUuid($uuid, false);

        return $propriedade->update($data);
    }
}