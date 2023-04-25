<?php

namespace Azuriom\Plugin\EfClassements\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\EfClassements\Models\Calculation;
use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Player;
use Azuriom\Plugin\EfClassements\Models\Ranking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\Relation;
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

        return view('ef-classements::admin.index', [
            "rankingList" => $rankingList
        ]);
    }

    public function rankingForm(Request $request){

        return \view('ef-classements::admin.ranking');
    }

    public function storeRanking(Request $request){
        $ranking = new Ranking();
        $ranking->name = $request->name;
        $calculation = Calculation::where('name', $request->calculation)->first();
        if($calculation == null){
            $calculation = new Calculation();
            $calculation->formula = 1;
            $calculation->name = $request->calculation;
            $calculation->save();
        }
        $ranking->calculation_id = $calculation->id;
        $ranking->save();
        $entity = $request->target;
        match($entity){
            "Faction" => $this->attachRankingToEntity(Faction::all(), $ranking),
            "Player" => $this->attachRankingToEntity(Player::all(), $ranking),
//            "Island" =>
        };

        $ranking->refresh();
        return redirect()->route('ef-classements.admin.settings')->with('status', 'Classement ajouté');
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
        if(count($ranking->players) > 0){
            $ranking->players()->detach();
        } elseif (count($ranking->faction) > 0){
            $ranking->faction()->detach();
        }
        $ranking->delete();
        return redirect()->route('ef-classements.admin.settings')->with('status', 'FactionCollection supprimer');
    }
}
