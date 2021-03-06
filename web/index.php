<?php

require_once __DIR__.'/../vendor/autoload.php';

use MyBattleEngine\RedisGameRepository;
use MyBattleEngine\SillyGame;
use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Silex\Application();

$app->register(new Predis\Silex\ClientServiceProvider(), [
    'predis.parameters' => 'tcp://127.0.0.1:6379',
    'predis.options'    => [
        'prefix'  => 'silex:',
        'profile' => '3.0',
    ]
]);

$app['game_repository'] = $app->share(function ($app) {
    return new RedisGameRepository($app['predis']);
});

$app->post('/battleship/game', function() use ($app) {
    $game = new SillyGame();
    $app['game_repository']->save($game);

    return new JsonResponse(
        [
            'gameId' => $game->id(),
            'grid' => $game->render()
        ]
    );
});

$app->post('/battleship/game/{id}/shot', function($id) use ($app) {

    /**
     * @var SillyGame $game
     */
    $game = $app['game_repository']->ofId($id);

    /**
     * @var \Battleship\Hole
     */
    $hole = $game->nextShot();

    $app['game_repository']->save($game);

    return new JsonResponse(
        [
            'letter' => $hole->letter(),
            'number' => $hole->number()
        ]
    );
});

$app->post('/battleship/game/{id}/shot-result/{result}', function($id, $result) use ($app) {
    $game = $app['game_repository']->ofId($id);

    // I should do something with the last result
    // but I'm too silly for that...

    $app['game_repository']->save($game);

    return new JsonResponse(
        [
            'result' => 0
        ]
    );
});

$app->post('/battleship/game/{id}/receive-shot/{letter}/{number}', function($id, $letter, $number) use ($app) {
    $game = $app['game_repository']->ofId($id);
    $result = $game->shotAt(new \Battleship\Hole($letter, (int) $number));
    $app['game_repository']->save($game);

    return new JsonResponse(
        [
            'result' => $result
        ]
    );
});

$app->delete('/battleship/game/{id}', function($id) use ($app) {
    $game = $app['game_repository']->ofId($id);
    $app['game_repository']->delete($game);

    return new JsonResponse([
        'result' => 'ok'
    ]);
});

$app->error(function (\Exception $e, $code) {
    return new JsonResponse(
        $e->getMessage(),
        $code
    );
});

$app->run();