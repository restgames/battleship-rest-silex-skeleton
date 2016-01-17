<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->post('/battleship/game', function() {
    return new \Symfony\Component\HttpFoundation\JsonResponse(
        [
            'gameId' => 1,
            'board' =>
                '03002222'.
                '03000000'.
                '03100000'.
                '00100050'.
                '00100050'.
                '00100444'.
                '00100000'.
                '00000000'
        ]
    );
});

$app->post('/battleship/game/{id}/fire', function($id) {
    $letters = range('A', 'G');
    $letter = $letters[array_rand($letters)];

    $numbers = range(1, 8);
    $number = $numbers[array_rand($numbers)];

    return new \Symfony\Component\HttpFoundation\JsonResponse(
        [
            'letter' => $letter,
            'number' => $number
        ]
    );
});

$app->post('/battleship/game/{id}/shot/{letter}/{number}', function($id, $letter, $number) {
    $letters = range('A', 'G');
    $letter = $letters[array_rand($letters)];

    $numbers = range(1, 8);
    $number = $numbers[array_rand($numbers)];

    return new \Symfony\Component\HttpFoundation\JsonResponse(
        [
            'result' => $letter
        ]
    );
});

$app->delete('/battleship/game/{id}', function($id) {
    return new \Symfony\Component\HttpFoundation\JsonResponse([
        'result' => 'ok'
    ]);
});

$app->run();