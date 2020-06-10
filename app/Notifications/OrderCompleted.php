<?php

namespace App\Notifications;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompleted extends Notification
{
    use Queueable;
    /**
     * @var Sale
     */
    private Sale $sale;

    /**
     * Create a new notification instance.
     *
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
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
     * @return \App\Mail\OrderCompleted
     */
    public function toMail($notifiable)
    {
        return (new \App\Mail\OrderCompleted($this->sale));
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
