<?php

namespace App\Notifications;

use App\Models\Order;
use http\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = $this->order;
        return (new MailMessage)
                    ->subject("Freight Payment request for Order ID: {$this->order->id}")
                    ->line("Hello,")
                    ->line("The order with the following details has received a go to release its Bill of Lading:")
                    ->line("ID: {$order->id}")
                    ->line("bl_release_date: {$order->bl_release_date}")
                    ->line("bl_release_user_id: {$order->bl_release_user_id}")
                    ->line("freight_payer_self: {$order->freight_payer_self}")
                    ->line("contract_number: {$order->contract_number}")
                    ->line("bl_number: {$order->bl_number}")
                    ->line("please pay the freight invoice so we can request it from the carrier and forward it to you:")
                    ->action("Pay freight invoice", url("/"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
