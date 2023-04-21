<?php

namespace Azuriom\Plugin\RankFaction\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Faction;
use Azuriom\Models\Rankable;

class FactionController extends Controller
{
    public function store(Faction $faction){
        $faction->save();
        $rankable = new Rankable();
        $rankable->add($faction);
    }
}
