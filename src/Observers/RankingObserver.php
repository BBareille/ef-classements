<?php

namespace Azuriom\Plugin\EfClassements\Observers;

use Azuriom\Plugin\EfClassements\Models\Calculation;
use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Player;
use Azuriom\Plugin\EfClassements\Models\Ranking;

class RankingObserver
{
    public function __construct(public Calculation $calculation)
    {
    }

    public function saved(Ranking $ranking): void{
        match($ranking->type){
            "Faction" => $this->attachRankingToEntity(Faction::all(), $ranking),
            "Player" => $this->attachRankingToEntity(Player::all(), $ranking),
        };
        $ranking->refresh();
    }

    public function deleting(Ranking $ranking){
        if($ranking->type == 'Player'){
            $ranking->players()->detach();
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
