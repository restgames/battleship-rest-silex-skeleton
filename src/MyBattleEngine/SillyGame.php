<?php

namespace MyBattleEngine;

use Battleship\Grid;
use Battleship\Hole;
use Ramsey\Uuid\Uuid;

class SillyGame implements Game
{
    /**
     * @var string
     */
    private $gameId;

    /**
     * @var Grid
     */
    private $grid;

    public function __construct($grid)
    {
        $this->grid = $grid;
        $this->gameId = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->gameId;
    }

    public function render()
    {
        return $this->grid->render();
    }

    public function shotAt(Hole $hole)
    {
        return $this->grid->shot($hole);
    }

    /**
     * @return Hole
     */
    public function nextShot()
    {
        $letters = range('A', 'J');
        $numbers = range(1, 10);

        return new Hole(
            $letters[array_rand($letters)],
            $numbers[array_rand($numbers)]
        );
    }
}