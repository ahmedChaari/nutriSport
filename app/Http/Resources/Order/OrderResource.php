<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductEmailResource;
use App\Http\Resources\Product\Productresource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->user->name,
            'total'  => $this->total,
            'reste'  => $this->reste,
            'status' => $this->status,
            'products'=> Productresource::collection($this->products),
            'created_at' => $this->created_at,
        ];
    }
}
