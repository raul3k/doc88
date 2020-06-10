<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Sale extends Model
{
    use Notifiable;

    protected $fillable = [
        'client_id',
        'orders',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function orders()
    {
        return collect(
            Str::of($this->orders)
                ->explode(',')
                ->map(fn($orderId) => Order::where('id', $orderId)->first())
        );
    }
}
