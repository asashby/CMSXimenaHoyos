<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATES = [
        0 => 'Cancelado',
        1 => 'Pendiente',
        2 => 'Entregado',
    ];

    protected $casts = [
        'detail' => 'object',
        'shipping' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStateNameAttribute()
    {
        return self::STATES[$this->state_id];
    }

    public function getShippingAddressFormatted()
    {
        return "{$this->shipping->country} {$this->shipping->state} {$this->shipping->city}, {$this->shipping->address_1}";
    }
}
