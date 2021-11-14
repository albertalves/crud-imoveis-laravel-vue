<?php

namespace App\Observers;

use App\Models\Contrato;
use Illuminate\Support\Str;

class ContratoObserver
{
    /**
     * Handle the Contrato "created" event.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return void
     */
    public function creating(Contrato $contrato)
    {
        $contrato->uuid = (string) Str::uuid();
    }
}
