<?php

namespace MyBattleEngine;

use Battleship\Hole;

interface Game
{
    /**
     * @return string
     */
    public function id();

    /**
     * @return string
     */
    public function render();

    /**
     * @param Hole $hole
     * @return int
     */
    public function shotAt(Hole $hole);

    /**
     * @return Hole
     */
    public function nextShot();
}