<?php

namespace Azuriom\Plugin\EfClassements\Observers;

use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Player;
use Azuriom\Plugin\EfClassements\Models\Ranking;

class PlayerObserver
{
    public function __construct(public Ranking $ranking)
    {
    }

    public function saved(Player $player){
        $rankings = Ranking::where('type', 'Player');

        foreach ($rankings as $ranking) {
            $ranking->faction()->attach($player);
        }
    }

    public function deleting(Player $player){
        $player->ranking()->detach();
    }
}
