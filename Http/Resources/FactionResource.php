<?php

namespace Azuriom\Http\Resources;

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
            "players" => PlayerResource::collection($this->players)
        ];
    }
}
