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
        $ranking->type = $request->target;
        $calculation = Calculation::where('name', $request->calculation)->first();
        if($calculation == null){
            $calculation = $this->newCalculation($request->calculation);
        }

        $ranking->calculation_id = $calculation->id;
        $ranking->save();

        return redirect()->route('ef-classements.admin.settings')->with('status', 'Classement ajouté');
    }

    private function newCalculation($name): Calculation{
        $calculation = new Calculation();
        $calculation->formula = 1;
        $calculation->name = $name;
        $calculation->save();
        return $calculation;
    }

    public function destroyRanking(Request $request)
    {
        $id = $request->input('id');
        $ranking = Ranking::find($id);
        $ranking->delete();

        return redirect()->route('ef-classements.admin.settings')->with('status', 'FactionCollection supprimer');
    }
}
