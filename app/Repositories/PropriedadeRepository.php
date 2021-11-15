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

    public function getAllPropriedades(array $request)
    {   
        $query = $this->entity->with('contrato');

        if(isset($request['search'])){

            $query->where('email_proprietario', 'LIKE', "%{$request['search']}%")
                    ->orWhere('rua', 'LIKE', "%{$request['search']}%")
                    ->orWhere('numero', 'LIKE', "%{$request['search']}%")
                    ->orWhere('cidade', 'LIKE', "%{$request['search']}%");
        }

        if(isset($request['buscarTodas']) && $request['buscarTodas'] == '1'){
            return $query->get();
        }

        return $query->paginate(3);
    }

    public function createPropriedade(array $data) 
    {
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
        $propriedade = $this->getPropriedadeByUuid($uuid, false);

        return $propriedade->delete();
    }

    /**
     *  Altera o status da propriedade caso ela tenha um contrato
     */
    public function updatePropriedadeStatusByUuid(string $id)
    {
        $this->entity->where('id', $id)->update(['status' => 1]);
    }
}