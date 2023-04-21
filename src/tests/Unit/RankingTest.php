<?php

namespace Tests\Unit;

use Database\Factories\RankingFactory;
use Tests\TestCase;

class RankingTest extends TestCase
{
    public function testDatabase()
    {
        $rankingFactory = new RankingFactory();
        $rankingFactory->create()->save();
    }
}
