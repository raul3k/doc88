<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'birthdate',
        'address',
        'complement',
        'neighborhood',
        'zipcode',
    ];

    protected $dateFormat = 'Y-m-d';
    protected $dates = ['birthdate'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
