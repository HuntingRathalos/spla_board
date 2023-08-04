<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $party = $this->resource;
        // assert($party->relationLoad('users'));

        return [
            'id' => $party->id,
            'owner_id' => $party->owner_id,
            'genre_id' => $party->genre_id,
            'body' => $party->body,
            'users' => UserResource::collection($this->whenLoaded('users')),
            'start_at' => $party->start_at,
            'finished_at' => $party->finished_at,
        ];
    }
}
