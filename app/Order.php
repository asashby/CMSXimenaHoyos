<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const CANCELADO = 0;
    public const PENDIENTE = 1;
    public const ENTREGADO = 2;

    public const STATES = [
        self::CANCELADO => 'Cancelado',
        self::PENDIENTE => 'Pendiente',
        self::ENTREGADO => 'Entregado',
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
