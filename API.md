API Interface
=============

## New game

Request:

    POST /battleship/game

Response:

    {
        gameId: "",
        grid: "0300222200030000000003100000000010005000001000500000100444000010000000000000000000000000000000000000"
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