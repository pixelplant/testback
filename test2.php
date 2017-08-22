<?php

require_once 'TransportationCard.php';
require_once 'TransportationSystem.php';

use BackendTest\TransportationSystem;
use BackendTest\TransportationCard;

$system = new TransportationSystem();
$system->addCards(
    [
        new TransportationCard(
            'Paris airport',
            'Geneva Cointrin',
            TransportationCard::TRANSPORTATION_TRAIN,
            'TGV 21A',
            '11B'
        ),
        new TransportationCard(
            'Zurich',
            'Singapore',
            TransportationCard::TRANSPORTATION_AIRPLANE,
            'SW900',
            '15B'
        ),
        new TransportationCard(
            'Geneva Cointrin',
            'Zurich',
            TransportationCard::TRANSPORTATION_AIRPLANE,
            'SW201',
            '30B'
        ),
        new TransportationCard(
            'Paris 3eme arrondisement',
            'Paris airport',
            TransportationCard::TRANSPORTATION_BUS,
            null,
            null
        ),
        new TransportationCard(
            'Singapore',
            'Singapore downtown',
            TransportationCard::TRANSPORTATION_TRAIN,
            'REG101',
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
