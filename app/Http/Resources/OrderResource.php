<?php

namespace App\Http\Resources;

use App\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'origin' => $this->origin,
            'detail' => $this->detail,
            'shipping' => $this->shipping,
            'cost_shipping' => $this->cost_shipping,
            'total' => $this->total,
            'state_id' => $this->state_id,
            'state_name' => Order::STATES[$this->state_id],
            'created_at' => $this->created_at,
        ];
    }
}
