<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const ORDER_RECEIVED = 'received';
    const ORDER_PREPARING = 'preparing';
    const ORDER_DONE = 'done';

    protected $fillable = [
        'client_id',
        'pastel_id',
        'status',
    ];

    public function isReceived()
    {
        return $this->status === self::ORDER_RECEIVED;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function pastel()
    {
        return $this->belongsTo(Pastel::class);
    }
}
