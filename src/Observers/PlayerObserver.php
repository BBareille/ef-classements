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
        $rankings = Ranking::where('type', 'Player')->get();

        foreach ($rankings as $ranking) {
            $ranking->players()->attach($player);
        }
    }

    public function deleting(Player $player){
        $player->players()->detach();
    }
}
