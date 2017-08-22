<?php

require_once 'Transportation/Journey.php';
require_once 'Transportation/Card.php';
require_once 'Transportation/BusCard.php';
require_once 'Transportation/TrainCard.php';
require_once 'Transportation/AirplaneCard.php';

use BackendTest\Transportation\Journey;
use BackendTest\Transportation\AirplaneCard;
use BackendTest\Transportation\BusCard;
use BackendTest\Transportation\TrainCard;

$journey = new Journey();
$journey->addCards(
    [
        new AirplaneCard(
            'Stockholm',
            'New York JFK',
            'SK22',
            '22',
            '7B',
            'Baggage will we automatically transferred from your last leg.'
        ),
        new AirplaneCard(
            'Gerona Airport',
            'Stockholm',
            'SK455',
            '45B',
            '3A',
            'Baggage drop at ticket counter 344.'
        ),
        new TrainCard(
            'Madrid',
            'Barcelona',
            '78A',
            '45B'
        ),
        new BusCard(
            'Barcelona',
            'Gerona Airport',
            '',
            null
        )
    ]
);

// order the transportation cards
$orderedCards = $journey->calculate();

if (empty($orderedCards)) {
    echo "Route is invalid or has more than 1 final starting/destination points\n";
} else {
    echo sprintf(
        "\nGoing from %s to %s, using %s transportation cards\n----------------\n",
        $journey->getStart(),
        $journey->getEnd(),
        sizeof($orderedCards)
    );
    foreach ($orderedCards as $order => $card) {
        echo ($order + 1) . '. ' . $card->formatRoute() . PHP_EOL;
    }
    echo sprintf(
        "----------------\nYou have arrived at your final destination.\n\n",
        $journey->getStart(),
        $journey->getEnd(),
        sizeof($orderedCards)
    );
}
