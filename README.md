# PHP Battleship REST Service Example using Silex

This is a PHP Battleship REST Service Example using Silex. This Battleship Engine is **really simple**. It always places the ships in the same position and shots randomly. With such an Artificial Intelligence (AI) you will not win any game. It's about you to improve it so you can win battles against your mates.

### What's REST Games?

Welcome to REST Games! Our goal is to provide you some coding challenges that go beyond the katas. You will implement a small JSON REST API that will play a well known game. The cool part comes when two mates develop the same JSON REST API and a _Referee_ can make them play one against the other. Cool, isn't it?

## Installation

    git clone https://github.com/restgames/battleship-rest-silex-skeleton
    cd battleship-rest-silex-skeleton
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

## Start REST Service

    redis-server &
    php -S localhost:8080 -t web web/index.php
