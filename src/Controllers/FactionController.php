<?php

namespace Azuriom\Plugin\RankFaction\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Faction;
use Azuriom\Models\Rankable;

class FactionController extends Controller
{
    public static function getPlayerListFromFaction(int $id){

        $faction = Faction::find($id);

        return count($faction->players);
    }
}
