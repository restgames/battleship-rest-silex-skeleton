<?php

namespace MyBattleEngine;

interface GameRepository
{
    /**
     * @param string $id
     * @return Game
     */
    public function ofId($id);

    /**
     * @param Game $game
     */
    public function save(Game $game);
}
