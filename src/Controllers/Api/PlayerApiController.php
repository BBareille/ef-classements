<?php

namespace Azuriom\Plugin\EfClassements\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\EfClassements\Models\Player;
use Illuminate\Http\Request;
use Azuriom\Plugin\EfClassements\Resources\PlayerResource;
use mysql_xdevapi\Exception;

class PlayerApiController extends Controller
{
    public function index()
    {
        return response()->json(Player::all());
    }

    public function store(Request $request)
    {
            $player = new Player();
            $player->id = $request->id;
            $player->user_id = $request->user_id ?? 1;
            $player->faction_id = $request->faction_id ?? null;
            $player->kills = $request->kills ?? 0;
            $player->deaths = $request->deaths ?? 0;
            $player->save();
            return response()->json($request);
    }

    public function show(int $playerId)
    {
        $player = new PlayerResource(Player::find($playerId));

        return response()->json($player);
    }

    public function update(Request $request)
    {
        try{
            return $this->store($request);
        }catch (\Exception $exception){
            return response()->json(["id" => $request->id, "error" => $exception->getMessage()]);
        }
    }
}
