<?php

namespace Azuriom\Plugin\EfClassements\Observers;

use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Ranking;

class FactionObserver
{
    public function __construct(public Ranking $ranking)
    {
    }

    public function saved(Faction $faction){
        $rankings = Ranking::where('type', 'Faction')->get();

        foreach ($rankings as $ranking) {
            $ranking->faction()->attach($faction);
        }
    }

    public function deleting(Faction $faction){
        $faction->ranking()->detach();
    }
}
