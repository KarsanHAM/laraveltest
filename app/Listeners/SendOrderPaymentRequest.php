<?php

namespace App\Listeners;

use App\Events\BillOfLadingReleased;
use App\Models\Order;
use App\Models\User;
use App\Notifications\PaymentRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendOrderPaymentRequest implements ShouldQueue
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
        $user = Auth::user();
        $user->notify(New PaymentRequest($event->order));
    }
}
