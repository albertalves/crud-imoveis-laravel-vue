<?php

namespace App\Http\Controllers\Api\v1\Propriedade;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePropriedade;
use App\Http\Resources\PropriedadeResource;
use App\Services\PropriedadeService;
use Illuminate\Http\Request;

class PropriedadeController extends Controller
{
    protected $propriedadeService;

    public function __construct(PropriedadeService $p)
    {
        $this->propriedadeService = $p;
    }


    public function index()
    {
        $propriedades = $this->propriedadeService->getPropriedades();

        return PropriedadeResource::collection($propriedades);
    }


    public function store(StoreUpdatePropriedade $request)
    {
        $propriedade = $this->propriedadeService->createPropriedade($request->validated());

        return new PropriedadeResource($propriedade);
    }


    public function show(string $uuid)
    {
        $propriedade = $this->propriedadeService->getPropriedade($uuid);

        return new PropriedadeResource($propriedade);
    }


    public function update(StoreUpdatePropriedade $request, string $uuid)
    {
        $this->propriedadeService->updatePropriedade($uuid, $request->validated());

        return response()->json(['message' => 'Registro editado com sucesso.'], 200);
    }


    public function destroy(string $uuid)
    {
        $propriedade = $this->propriedadeService->deletePropriedade($uuid);

        return response()->json(['message' => 'Registro exluído com sucesso.'], 204);
    }
}
