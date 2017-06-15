<?php

include __DIR__ . '\..\..\vendor\autoload.php';

use Kata\DataMunging\DataMunger;

$dataMunger = new DataMunger();

$day = $dataMunger->getDay(__DIR__ . '\weather.dat');
echo sprintf('The day with minimal temperature difference is %d.', $day) . PHP_EOL;

$team = $dataMunger->getTeam(__DIR__ . '\football.dat');
echo sprintf('The team with minimal goal difference is %s.', $team) . PHP_EOL;
