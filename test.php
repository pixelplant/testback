<?php

require_once 'TransportationCard.php';
require_once 'TransportationSystem.php';

use BackendTest\TransportationSystem;
use BackendTest\TransportationCard;

$system = new TransportationSystem();
$system->addCards(
    [
        new TransportationCard(
            'Stockholm',
            'New York JFK',
            TransportationCard::TRANSPORTATION_AIRPLANE,
            'SK22',
            'Gate 22, seat 7B'
        ),
        new TransportationCard(
            'Gerona Airport',
            'Stockholm',
            TransportationCard::TRANSPORTATION_AIRPLANE,
            'SK455',
            'Gate 45B, seat 3A'
        ),
        new TransportationCard(
            'Madrid',
            'Barcelona',
            TransportationCard::TRANSPORTATION_TRAIN,
            '78A',
            '45B'
        ),
        new TransportationCard(
            'Barcelona',
            'Gerona Airport',
            TransportationCard::TRANSPORTATION_BUS,
            '',
            null
        )
    ]
);

// order the transportation cards
$orderedCards = $system->calculateJourney();

if (empty($orderedCards)) {
    echo "Route is invalid or has more than 1 final starting/destination points\n";
} else {
    echo sprintf(
        "\nGoing from %s to %s, using %s transportation cards\n----------------\n",
        $system->getStart(),
        $system->getEnd(),
        sizeof($orderedCards)
    );
    foreach ($orderedCards as $card) {
        echo $card->getFormattedRoute() . PHP_EOL;
    }
    echo sprintf(
        "----------------\nYou have arrived at your final destination.\n\n",
        $system->getStart(),
        $system->getEnd(),
        sizeof($orderedCards)
    );
}
