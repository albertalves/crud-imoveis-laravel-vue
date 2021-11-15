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


    public function index(Request $request)
    {
        $propriedades = $this->propriedadeService->getPropriedades($request->all());

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


    public function update(Request $request)
    {
        $this->propriedadeService->updatePropriedadeStatus($request->only(['id']));
    }


    public function destroy(string $uuid)
    {
        $propriedade = $this->propriedadeService->deletePropriedade($uuid);

        return response()->json(['message' => 'Registro exluído com sucesso.'], 204);
    }
}
