<?php

namespace App\Listeners;

use App\Events\PocketContentSaved;
use App\Jobs\ScrapContentDetails;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class QueueContentForScraping
{
    /**
     * Handle the event.
     *
     * @param  PocketContentSaved  $event
     * @return void
     */
    public function handle(PocketContentSaved $event)
    {
        ScrapContentDetails::dispatch($event->content);
    }
}
