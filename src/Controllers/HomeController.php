<?php

namespace Azuriom\Plugin\EfClassements\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\EfClassements\Models\Ranking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $rankingList = Ranking::all();
//        foreach ($rankingList as $ranking)
//        {
//
//            $mainColumn = \Azuriom\Plugin\EfClassements\Models\Column::find($ranking->orderBy)->name;
//
//            if($ranking->player){
//                foreach ($ranking->getSortedEntityBy('Player', $mainColumn) as $player)
//                {
////            $test = new Ranking();
//                    dd($player->name);
//                }
//            }
//
//        }

        return view('ef-classements::index', [
            'rankingList' => $rankingList
        ]);
    }
}
