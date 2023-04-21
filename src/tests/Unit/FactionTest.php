<?php

namespace Tests\Unit;

use Azuriom\Models\Faction;
use Database\Factories\FactionFactory;
use Database\Factories\PlayerFactory;
use Database\Factories\RankingFactory;
use Tests\TestCase;

class FactionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        $playerFactory = new PlayerFactory();
        $rankingFactory = new RankingFactory();
        $factionFactory = new FactionFactory();


        $ranking = $rankingFactory->create();
        $ranking_id = $ranking->id;

        $factionFactory->count(10)->create([
            'ranking_id' => $ranking_id
        ]);

        $playerFactory->count(50)->create([
            'faction_id' => function() {
                return Faction::all()->random()->id;
        }
        ]);
    }
}
