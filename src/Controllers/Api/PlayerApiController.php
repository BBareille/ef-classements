<?php

namespace Azuriom\Plugin\RankFaction\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Http\Resources\FactionResource;
use Azuriom\Http\Resources\PlayerResource;
use Azuriom\Models\Faction;
use Azuriom\Models\Player;
use Illuminate\Http\Request;

class PlayerApiController extends Controller
{
    public function index()
    {
        return response()->json(Player::all());
    }

    public function store(Request $request)
    {
        $player = new Player();
        $player->user_id = $request->user_id;
        $player->faction_id = $request->faction_id ?? null;
        $player->kills = $request->kills ?? 0;
        $player->deaths = $request->deaths ?? 0;
        $player->save();
        return response()->json($player);
    }

    public function show(int $playerId)
    {
        $player = new PlayerResource(Player::find($playerId));

        return response()->json($player);
    }

    public function update(Request $request)
    {
        $player = Player::find($request->id);
        $player->faction_id = $request->faction_id ?? $player->faction_id;
        $player->kills = $request->kills ?? $player->kills;
        $player->deaths = $request->deaths ?? $player->deaths;
        $player->save();

        return response()->json($player);
    }
}
