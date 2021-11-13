<?php

namespace App\Observers;

use App\Models\Propriedade;
use Illuminate\Support\Str;

class PropriedadeObserver
{
    /**
     * Handle the Propriedade "created" event.
     *
     * @param  \App\Models\Propriedade  $propriedade
     * @return void
     */
    public function creating(Propriedade $propriedade)
    {
        $propriedade->uuid = (string) Str::uuid();
    }

    /**
     * Handle the Propriedade "updated" event.
     *
     * @param  \App\Models\Propriedade  $propriedade
     * @return void
     */
    public function updated(Propriedade $propriedade)
    {
        //
    }

    /**
     * Handle the Propriedade "deleted" event.
     *
     * @param  \App\Models\Propriedade  $propriedade
     * @return void
     */
    public function deleted(Propriedade $propriedade)
    {
        //
    }

    /**
     * Handle the Propriedade "restored" event.
     *
     * @param  \App\Models\Propriedade  $propriedade
     * @return void
     */
    public function restored(Propriedade $propriedade)
    {
        //
    }

    /**
     * Handle the Propriedade "force deleted" event.
     *
     * @param  \App\Models\Propriedade  $propriedade
     * @return void
     */
    public function forceDeleted(Propriedade $propriedade)
    {
        //
    }
}
