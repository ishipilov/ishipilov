<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingListResource extends JsonResource
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
            'id' => $this->id,
            'text' => $this->text,
            'active' => $this->options['active'],
            'user' => new UserResource($this->user),
            'urls' => [
                'show' => route('api.shoppinglist.show', $this),
                'toggle' => route('api.shoppinglist.toggle', $this),
            ],
        ];
    }
}
