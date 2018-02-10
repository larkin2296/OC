<?php

namespace App\Listeners\Report\Value;

use App\Events\Report\Value\SetReportMainData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetReportMainDataListener
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
     * @param  SetReportMainData  $event
     * @return void
     */
    public function handle(SetReportMainData $event)
    {
        //
    }
}
