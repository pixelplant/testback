<?php

namespace BackendTest\Transportation;

/**
 * Base transportation card class, with default methods and properties
 * Since it's abstract, you always instantiate only it's child classes
 *
 * @package BackendTest\Transportation
 */
abstract class Card
{
    /**
     * Destination start
     *
     * @var string
     */
    protected $from;

    /**
     * Destination end
     *
     * @var string
     */
    protected $to;

    /**
     * Connection name (flight number, train name, etc)
     *
     * @var string
     */
    protected $connectionName;

    /**
     * Seat assignment value or null if none assigned
     *
     * @var mixed
     */
    protected $seat = null;

    /**
     * TransportationCard constructor.
     *
     * @param string $from
     * @param string $to
     * @param string $connection Connection name (Name of the bus, flight, etc)
     * @param string $seat Seat name/number
     */
    public function __construct($from, $to, $connection = null, $seat = null)
    {
        $this
            ->setFrom($from)
            ->setTo($to)
            ->setConnectionName($connection)
            ->setSeat($seat);
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     *
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $to
     *
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param mixed $seat
     *
     * @return $this
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;

        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionName()
    {
        return $this->connectionName;
    }

    /**
     * @param string $connectionName
     *
     * @return $this
     */
    public function setConnectionName($connectionName)
    {
        $this->connectionName = $connectionName;

        return $this;
    }

    /**
     * Method used to format the route of a Card.
     * Abstract, since it must only be defined in it's child class
     *
     * @return string
     */
    abstract public function formatRoute();
}
