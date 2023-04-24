<?php

namespace Azuriom\Plugin\RankFaction\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Faction;
use Azuriom\Http\Resources\FactionResource;
use Illuminate\Http\Request;

class FactionApiController extends Controller
{
    public function index()
    {
        return response()->json(Faction::all());
    }

    public function store(Request $request)
    {
        $faction = new Faction();
        $faction->name = $request->name;
        $faction->koth = $request->koth ?? 0;
        $faction->totem = $request->totem ?? 0;
        $faction->save();
        return response()->json($faction);
    }

    public function show(int $factionId)
    {
        $faction = new FactionResource(Faction::find($factionId));

        return response()->json($faction);
    }

    public function update(Request $request)
    {
        $faction = Faction::find($request->id);
        $faction->name = $request->name ?? $faction->name;
        $faction->totem = $request->totem ?? $faction->totem;
        $faction->koth = $request->koth ?? $faction->koth;
        $faction->save();

        return response()->json($faction);
    }

    public function destroy(Request $request) {
        $faction = Faction::destroy($request->id);

        return response()->json($faction);
    }
}
