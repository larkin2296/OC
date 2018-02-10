<?php

namespace App\Listeners;

use App\Events\FlushCache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Artisan;

class FlushCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FlushCache  $event
     * @return void
     */
    public function handle(FlushCache $event)
    {
        Artisan::call('cache:clear');
    }
}
