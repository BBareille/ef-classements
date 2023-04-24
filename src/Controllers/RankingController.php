<?php

namespace Azuriom\Plugin\RankFaction\Controllers;

use Azuriom\Http\Controllers\Controller;

class RankingController extends Controller
{
    public static function getListOfTargetEntities(){
        return ['Faction', 'Player', 'Island'];
    }
}
