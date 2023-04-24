<?php

namespace Azuriom\Plugin\RankFaction\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Faction;
use Azuriom\Models\Ranking;
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
        $factionList = Faction::getRankBy();
        $rankingList = Ranking::all();
        return view('rank-faction::index', [
            'factionList' => $factionList,
            'rankingList' => $rankingList
        ]);
    }
}
