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

    private $nextShot;

    public function __construct($grid)
    {
        $this->grid = $grid;
        $this->gameId = Uuid::uuid4()->toString();
        $this->nextShot = -1;
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
        $this->nextShot++;

        $letters = range('A', 'J');
        $numbers = range(1, 10);

        return new Hole(
            $letters[$this->nextShot / 10],
            $numbers[$this->nextShot % 10]
        );
    }
}