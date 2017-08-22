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
        new TrainCard(
            'Paris airport',
            'Geneva Cointrin',
            'TGV 21A',
            '11B'
        ),
        new AirplaneCard(
            'Zurich',
            'Singapore',
            'SW900',
            '15B',
            '12'
        ),
        new AirplaneCard(
            'Geneva Cointrin',
            'Zurich',
            'SW201',
            '20B',
            '11',
            'Baggage drop at ticket counter 10.'
        ),
        new BusCard(
            'Paris 3eme arrondisement',
            'Paris airport'
        ),
        new TrainCard(
            'Singapore',
            'Singapore downtown',
            'REG101'
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
