<?php

namespace Azuriom\Plugin\EfClassements\Controllers;

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
        $rankingList = Ranking::all();
        return view('ef-classements::index', [
            'rankingList' => $rankingList
        ]);
    }
}
