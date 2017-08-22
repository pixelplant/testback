<?php

namespace BackendTest\Transportation;

class AirplaneCard extends Card
{
    /**
     * @var string
     */
    protected $gate;

    /**
     * @var string
     */
    protected $baggage;

    /**
     * TransportationCard constructor.
     *
     * @param string $from
     * @param string $to
     * @param string $connection Connection name (Name of the bus, flight, etc)
     * @param mixed  $seat Seat name/number
     * @param mixed  $gate Gate name/number
     * @param string $baggage Baggage info, stored as a simple string
     */
    public function __construct($from, $to, $connection, $seat = null, $gate = null, $baggage = '')
    {
        parent::__construct($from, $to, $connection, $seat);
        $this
            ->setGate($gate)
            ->setBaggage($baggage);
    }

    /**
     * Return the formatted route fur bus rides
     *
     * @return string
     */
    public function formatRoute()
    {
        $seat = $this->getSeat() ? 'Gate ' . $this->getGate() . ', seat ' . $this->getSeat() . '.' : 'No seat assignment.';

        return sprintf(
            "From %s, take flight %s to %s. %s %s",
            $this->getFrom(),
            $this->getConnectionName(),
            $this->getTo(),
            $seat,
            $this->getBaggage()
        );
    }

    /**
     * @return string
     */
    public function getGate()
    {
        return $this->gate;
    }

    /**
     * @param string $gate
     *
     * @return $this
     */
    public function setGate($gate)
    {
        $this->gate = $gate;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaggage()
    {
        return $this->baggage;
    }

    /**
     * @param string $baggage
     *
     * @return $this
     */
    public function setBaggage($baggage)
    {
        $this->baggage = $baggage;

        return $this;
    }
}
