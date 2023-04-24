<?php

namespace Azuriom\Plugin\RankFaction\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Calculation;

class RankingController extends Controller
{
    public static function getListOfTargetEntities(){
        return ['Faction', 'Player', 'Island'];
    }

    public static function getListOfCalculation(){

        return Calculation::all();
    }
}
