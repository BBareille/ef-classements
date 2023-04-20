<?php

namespace Azuriom\Plugin\RankFaction\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\RankFaction\Models\Faction;
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
        $factionList = Faction::getRankBy();

        return view('rank-faction::admin.index', [
            "factionList" => $factionList
        ]);
    }

    public function store(Request $request)
    {
        $faction = new Faction();
        $faction->name = $request->name;
        $faction->points = $request->points;
        $faction->save();
        return redirect()->route('rank-faction.admin.settings')->with('status', 'Faction ajouté');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $faction = Faction::find($id);
        $faction->delete();
        return redirect()->route('rank-faction.admin.settings')->with('status', 'Faction ajouté');
    }
}
