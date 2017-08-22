<?php

namespace BackendTest\Transportation;

class Journey
{
    /**
     * Transportation Cards array
     *
     * @var array
     */
    protected $cards;

    /**
     * List of all registered starting points
     *
     * @var array
     */
    protected $startingPoints = [];

    /**
     * List of all destination points
     *
     * @var array
     */
    protected $destinationPoints = [];

    /**
     * Start point
     *
     * @var string
     */
    protected $start = '';

    /**
     * Destination point
     *
     * @var string
     */
    protected $end = '';

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Add multiple transportation cards
     *
     * @param $cards
     */
    public function addCards($cards)
    {
        foreach ($cards as $card) {
            $this->addCard($card);
        }
    }

    /**
     * Add one transportation card at a time
     *
     * @param Card $card
     */
    public function addCard($card)
    {
        $this->cards[ $card->getFrom() ] = $card;
        $this->startingPoints[]          = $card->getFrom();
        $this->destinationPoints[]       = $card->getTo();
    }

    /**
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param string $start
     *
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param string $end
     *
     * @return $this
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Returns the ordered list of cards
     *
     * @return array
     */
    public function calculate()
    {
        // since we've cached our destinations, we can easily see which is our starting point and our destination
        // the diff between these 2 arrays should always return only 1 element, otherwise we have multiple unconnected
        // routes or the route is unreachable
        $startingPoints    = array_diff($this->getStartingPoints(), $this->getDestinationPoints());
        $destinationPoints = array_diff($this->getDestinationPoints(), $this->getStartingPoints());

        $orderedCards = [];
        // A valid route has only 1 starting point and 1 final destination, otherwise it's invalid
        if ((sizeof($startingPoints) === 1) && (sizeof($destinationPoints) === 1)) {
            $goingFrom    = reset($startingPoints);
            $goingTo      = reset($destinationPoints);
            $counter      = 0;
            $this->setStart($goingFrom);
            $this->setEnd($goingTo);
            while (true) {
                $card           = $this->cards[ $goingFrom ];
                $orderedCards[] = $card;
                $goingFrom      = $card->getTo();
                $counter++;
                if ($counter >= sizeof($this->cards)) {
                    break;
                }
            }
        }

        return $orderedCards;
    }

    /**
     * Get cached list of starting points
     *
     * @return array
     */
    public function getStartingPoints()
    {
        return $this->startingPoints;
    }

    /**
     * Get cached list of destination points
     *
     * @return array
     */
    public function getDestinationPoints()
    {
        return $this->destinationPoints;
    }
}
