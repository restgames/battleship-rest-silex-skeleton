PHP Battleship REST Service Example using Silex
===============================================

This is a PHP Battleship REST Service Example using Silex. This Battleship Engine is **really simple**. It always places the ships in the same position and shots randomly. With such an Artificial Intelligence (AI) you will not win any game. It's about you to improve it so you can win battles against your mates.

## Installation

    git clone https://github.com/restgames/battleship-rest-silex-skeleton
    cd battleship-rest-silex-skeleton
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

## Start REST Service

    redis-server &
    php -S localhost:8080 -t web web/index.php

## New game

Request:

    POST /battleship/game

Response:

    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Thu, 21 Jan 2016 12:48:23 GMT
    Host: localhost:8080
    X-Powered-By: PHP/5.6.17

    {
        "board": "0300222200030000000003100000000010005000001000500000100444000010000000000000000000000000000000000000",
        "gameId": "436fb958-dd1e-4764-9b44-a60393ed1912"
    }

## Call your shot

Request:

    POST /battleship/game/:gameId/shot

Response:

    {
        letter: "",
        number: ""
    }

## Receive a shot from opponents

Request:

    POST /battleship/game/:gameId/fire/:letter/:number

Response:

    {
        result: 0
    }

* 0: Miss
* 1: Hit
* 2: Sunk!

## Finish a game

Referee will call this method after the game has ended. You can use this call for performing cleaning up tasks, such as removing the game from any persistence mechanism.

Request:

    DELETE /battleship/game/:gameId

Response:

    {
        result: 0
    }

Check an example.

    $battleshipGrid = Grid::fromString(
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

    $shotResults =
        '0100111200'.
        '0100000000'.
        '0210000000'.
        '0010001000'.
        '0010002000'.
        '0010011200'.
        '0020000000'.
        '0000000000'.
        '0000000000'.
        '0000000000';

    $this->assertTrue($this->grid->areAllShipsPlaced());
    $this->assertFalse($this->grid->areAllShipsSunk());

    foreach(Grid::letters() as $l => $letter) {
        foreach(Grid::numbers() as $n => $number) {
            $this->assertSame(
                (int) $shotResults{$l * 10 + $n},
                $battleshipGrid->shot(new Hole($letter, $number))
            );
        }
    }

    $this->assertTrue($battleshipGrid->areAllShipsSunk());
