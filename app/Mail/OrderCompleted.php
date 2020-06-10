<?php

namespace App\Mail;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use NumberFormatter;

class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Sale
     */
    private Sale $sale;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'sale' => $this->sale,
            'totalInvoice' => 0,
            'currencyFormatter' => new NumberFormatter('pt_BR', NumberFormatter::CURRENCY),
        ];
        $this
            ->sale
            ->orders()
            ->each(function($order) use (&$data) {
                    $data['totalInvoice'] += $order->pastel->price;
                });

        return $this
            ->from('raul.3k+pastelaria@gmail.com')
            ->to($this->sale->client->email)
            ->view('mail.order-completed', $data);
    }
}
