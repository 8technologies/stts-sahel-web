<?php

namespace App\Observers;

use App\Models\AgroDealer;

class AgroDealerObserver
{
    /**
     * Handle the AgroDealer "created" event.
     */
    public function created(AgroDealer $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "updated" event.
     */
    public function updated(AgroDealer $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "deleted" event.
     */
    public function deleted(AgroDealer $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "restored" event.
     */
    public function restored(AgroDealer $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "force deleted" event.
     */
    public function forceDeleted(AgroDealer $agroDealer): void
    {
        //
    }
}
