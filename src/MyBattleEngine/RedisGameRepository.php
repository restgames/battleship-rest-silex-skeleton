<?php

namespace MyBattleEngine;

class RedisGameRepository implements GameRepository
{
    private $predis;

    public function __construct($pRedisClient)
    {
        $this->predis = $pRedisClient;
    }

    public function ofId($id)
    {
        $serializedResult = $this->predis->get('game:'.$id);
        if (!$serializedResult) {
            throw new \InvalidArgumentException('Game does not exist');
        }

        $result = @unserialize($serializedResult);
        if (!$result) {
            throw new \InvalidArgumentException('There was a problem unserializing the game');
        }

        return $result;
    }

    public function save(Game $game)
    {
        $this->predis->set('game:'.$game->id(), serialize($game));
    }

    public function delete(Game $game)
    {
        $this->predis->del('game:'.$game->id());
    }
}
