<?php

namespace Azuriom\Plugin\RankFaction\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\RankFaction\Models\Faction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RankFactionHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $faction = new Faction([], 'S2F', 1500);
        $faction2 = new Faction([], 'Faction_2', 1200);

        $factionList = [$faction, $faction2];
        return view('rank-faction::index', [
            'factionList' => $factionList
        ]);
    }
}
