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

    public function __construct()
    {
        $this->grid = Grid::fromString(
            '0300222200'.
            '0300000000'.
            '0310000000'.
            '0010005000'.
            '0010005000'.
            '0010044400'.
            '0010000000'.
            '0000000000'.
            '0000000000'.
            '0000000000'
        );
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