<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pastel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'photo',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
