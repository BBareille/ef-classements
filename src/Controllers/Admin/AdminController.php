<?php

namespace Azuriom\Plugin\EfClassements\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\EfClassements\Models\Column;
use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Player;
use Azuriom\Plugin\EfClassements\Models\Ranking;
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

        return view('ef-classements::admin.index', [
            "rankingList" => $rankingList
        ]);
    }

    public function rankingForm(Request $request){

        $faction_args = get_class_vars(Faction::class);
        $player_args = get_class_vars(Player::class);
        $entities = [
            'Faction' => $faction_args['params'],
            'Player' => $player_args['params']
        ];

        return \view('ef-classements::admin.ranking', [
            'entities' => $entities,
        ]);
    }

    public function storeRanking(Request $request){
        $ranking = new Ranking();
        $ranking->name = $request->name;
        $ranking->type = $request->target;
        $mainColumn = new Column();
        $mainColumn->name = $request->calculation;
        $mainColumn->isDisplayed = true;
        $mainColumn->save();
        $columnList = [];
        foreach ($request->columns as $column){
            $newColumn = new Column();
            $newColumn->name = $column;
            $newColumn->isDisplayed = true;
            foreach ($request->weight as $key => $weight){
                if ($newColumn->name == $key){
                    $newColumn->weight = $weight;
                }
            }
            $columnList[] = $newColumn;
        }

        $ranking->orderBy = $mainColumn->id;

        $ranking->refresh();
        $ranking->save();
        $ranking->columns()->saveMany($columnList);

        return redirect()->route('ef-classements.admin.settings')->with('status', 'Classement ajouté');
    }

//    private function newCalculation($name): Calculation{
//        $calculation = new Calculation();
//        $calculation->formula = 1;
//        $calculation->name = $name;
//        $calculation->save();
//        return $calculation;
//    }

    public function destroyRanking(Request $request)
    {
        $id = $request->input('id');
        $ranking = Ranking::find($id);
        $ranking->delete();

        return redirect()->route('ef-classements.admin.settings')->with('status', 'FactionCollection supprimer');
    }
}
