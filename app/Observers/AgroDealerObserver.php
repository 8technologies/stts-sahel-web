<?php

namespace App\Observers;

use App\Models\AgroDealers;
use Illuminate\Support\Facades\DB; 

class AgroDealerObserver
{
    /**
     * Handle the AgroDealer "created" event.
     */
    public function created(AgroDealers $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "updated" event.
     */
    public function updated(AgroDealers $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "deleted" event and changes ther users role to basic user and deletes the notifications. 
     */
    public function deleted(AgroDealers $agroDealer): void
    {
        DB::table('admin_role_users')
            ->where('user_id', $agroDealer->user_id)
            ->update(['role_id' => 3]);
        DB::table('notifications')
        ->where('receiver_id', $agroDealer->user_id)
        ->delete();
    }

    /**
     * Handle the AgroDealer "restored" event.
     */
    public function restored(AgroDealers $agroDealer): void
    {
        //
    }

    /**
     * Handle the AgroDealer "force deleted" event.
     */
    public function forceDeleted(AgroDealers $agroDealer): void
    {
        //
    }
}
