<?php

namespace Azuriom\Plugin\EfClassements\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Resources\FactionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FactionApiController extends Controller
{
    public function index()
    {
        return response()->json(Faction::all());
    }

    public function store(Request $request)
    {
        $faction = new Faction();
        $faction->id = $request->id;
        $faction->name = $request->name ?? "Erreur ?";
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
        $faction = Faction::find($request->id);
        $faction->players()->detach();
        $faction->delete();

        return response()->json($faction);
    }
}
