<?php

namespace App\Http\Controllers\Api\v1\Contrato;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContrato;
use App\Http\Resources\ContratoResource;
use App\Services\ContratoService;

class ContratoController extends Controller
{
    protected $contratoService;

    public function __construct(ContratoService $c)
    {
        $this->contratoService = $c;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContrato $request)
    {
        $contrato = $this->contratoService->createContrato($request->validated());

        return new ContratoResource($contrato);
    }
}
