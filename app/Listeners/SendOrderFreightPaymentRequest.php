<?php

namespace App\Listeners;

use App\Events\BillOfLadingReleased;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderFreightPaymentRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendOrderFreightPaymentRequest implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BillOfLadingReleased  $event
     * @return void
     */
    public function handle(BillOfLadingReleased $event)
    {
        Auth::user()->notify(New OrderFreightPaymentRequest($event->order));
    }
}
