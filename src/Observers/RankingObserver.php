<?php

namespace Azuriom\Plugin\EfClassements\Observers;

use Azuriom\Plugin\EfClassements\Models\Column;
use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Player;
use Azuriom\Plugin\EfClassements\Models\Ranking;

class RankingObserver
{
    public function __construct()
    {
    }

    public function saved(Ranking $ranking): void
    {
        $column = Column::find($ranking->orderBy);
        $column->ranking_id = $ranking->id;
        $column->save();

        match($ranking->type){
            "Faction" => $this->attachRankingToEntity(Faction::all(), $ranking),
            "Player" => $this->attachRankingToEntity(Player::all(), $ranking),
        };
        $ranking->refresh();
    }

    public function deleting(Ranking $ranking): void
    {
        if($ranking->type == 'Player'){
            $ranking->player()->detach();
        } elseif ($ranking->type == 'Faction'){
            $ranking->faction()->detach();
        }
    }

    private function attachRankingToEntity($entities, $ranking): void
    {
        foreach ($entities as $entity){
            $entity->ranking()->attach($ranking);
        }
    }
}
