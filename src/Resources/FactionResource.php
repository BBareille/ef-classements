<?php

namespace Azuriom\Plugin\EfClassements\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "totem" => $this->totem,
            "koth" => $this->koth,
            "players" => \Azuriom\Http\Resources\PlayerResource::collection($this->players)
        ];
    }
}
