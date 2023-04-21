<?php

namespace Tests\Unit;

use Database\Factories\PlayerFactory;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        $playerFactory = PlayerFactory::new();

        $player = $playerFactory->create();
    }

}
