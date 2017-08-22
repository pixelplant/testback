# Transportation system

In order to run this code you need to be running at least PHP version 5.6

There are 2 tests available, inside `test.php` and `test2.php`
* `test.php` contains the transportation cards from the PDF specification
* `test2.php` contains different values for the transportation cards

In order to execute the code, run it in the shell/cli (command line), inside the project folder, like so:
`php test.php` or `php test2.php`

You should get an output like this one:
```
Going from Paris 3eme arrondisement to Singapore downtown, using 5 transportation cards
----------------
Take the bus from Paris 3eme arrondisement to Paris airport, No seat assignment.
Take train TGV 21A from Paris airport to Geneva Cointrin. Sit in seat 11B.
From Geneva Cointrin, take flight SW201 to Zurich, 30B.
From Zurich, take flight SW900 to Singapore, 15B.
Take train REG101 from Singapore to Singapore downtown. No seat assignment.
----------------
You have arrived at your final destination.
```

You are free to modify any of the 2 files in order to change the input.

## Classes information

The 2 main classes are:
* `TransportationCard` - holds all the information of a transportation card, as "from" and "to" destinations, type of transportation, seat number, etc
* `TransportationSystem` - gets as input the transportation cards and calculates the journey, returning the correct ordered list of cards, or an empty array if the route is not valid. (see method `calculateJourney`).