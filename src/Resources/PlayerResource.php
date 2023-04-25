<?php

namespace Azuriom\Plugin\EfClassements\Resources;

use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user" => [
                'id' =>$this->user_id,
                'name' => User::find($this->user_id)->name,
            ],
            "faction" => [
                "id" => $this->faction_id,
                "name" => Faction::find($this->faction_id)->name,
            ],
            "stats" => [
                "kills" => $this->kills,
                "deaths" => $this->deaths,
            ]
        ];
    }
}
