<?php

namespace Azuriom\Plugin\RankFaction\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Calculation;
use Azuriom\Models\Faction;
use Azuriom\Models\Player;
use Azuriom\Models\Rankable;
use Azuriom\Models\Ranking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    /**
     * Show the home admin page of the plugin.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $rankingList = Ranking::all();

        return view('rank-faction::admin.index', [
            "rankingList" => $rankingList
        ]);
    }

    public function rankingForm(Request $request){

        return \view('rank-faction::admin.ranking');
    }

    public function storeRanking(Request $request){
        $ranking = new Ranking();
        $ranking->name = $request->name;
        $calculation = Calculation::where('name', $request->calculation)->first();
        $ranking->calculation_id = $calculation->id;
        $ranking->save();
        $entity = $request->target;
        match($entity){
            "FactionCollection" => $this->attachRankingToEntity(Faction::all(), $ranking),
            "Player" => $this->attachRankingToEntity(Player::all(), $ranking),
//            "Island" => $ranking->targetEntities()->saveMany(Island::all())
        };

        $ranking->refresh();
        return redirect()->route('rank-faction.admin.settings')->with('status', 'Classement ajouté');
    }

    private function attachRankingToEntity($entities, $ranking){
        foreach ($entities as $entity){
            $entity->ranking()->save($ranking);
        }
    }

    public function destroyRanking(Request $request)
    {
        $id = $request->input('id');
        $ranking = Ranking::find($id);
        $ranking->targetEntities()->detach();
        $ranking->delete();
        return redirect()->route('rank-faction.admin.settings')->with('status', 'FactionCollection supprimer');
    }
}
