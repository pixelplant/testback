<?php

namespace BackendTest;

class TransportationCard
{
    /**
     * Transportation types
     */
    const TRANSPORTATION_TRAIN    = 'train';
    const TRANSPORTATION_AIRPLANE = 'airplane';
    const TRANSPORTATION_BUS      = 'bus';

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
     * Type of transportation to use
     *
     * @var string
     */
    protected $transportationType;

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
     * Additional information, like baggage info, etc
     *
     * @var
     */
    protected $info = '';

    /**
     * TransportationCard constructor.
     *
     * @param string $from
     * @param string $to
     * @param string $transportationType
     * @param string $connection
     * @param string $seat
     * @param string $info Additional flight information, like baggage details, etc
     */
    public function __construct($from, $to, $transportationType, $connection, $seat, $info = '')
    {
        $this
            ->setFrom($from)
            ->setTo($to)
            ->setTransportationType($transportationType)
            ->setConnectionName($connection)
            ->setSeat($seat)
            ->setInfo($info);
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
     * @return string
     */
    public function getTransportationType()
    {
        return $this->transportationType;
    }

    /**
     * @param string $transportationType
     *
     * @return $this
     */
    public function setTransportationType($transportationType)
    {
        $this->transportationType = $transportationType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     *
     * @return $this
     */
    public function setInfo($info)
    {
        $this->info = $info;

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
     * Return the complete journey details of the current transportation card
     *
     * @return string
     */
    public function getFormattedRoute()
    {
        $labels = [
            self::TRANSPORTATION_BUS      => 'Take the bus from %(from) to %(to), %(seatInfo)',
            self::TRANSPORTATION_AIRPLANE => 'From %(from), take flight %(connection) to %(to), %(seatInfo)',
            self::TRANSPORTATION_TRAIN    => 'Take train %(connection) from %(from) to %(to). %(seatInfo)',
        ];

        $formattedLabel = $labels[ $this->getTransportationType() ];

        $map = [
            '%(from)'       => $this->getFrom(),
            '%(to)'         => $this->getTo(),
            '%(seatInfo)'   => $this->getFormattedSeat(),
            '%(connection)' => $this->getConnectionName()
        ];

        return strtr($formattedLabel, $map);
    }

    /**
     * Return a formatted label with the seat details, depending on the type of transportation
     *
     * @return string
     */
    public function getFormattedSeat()
    {
        if (is_null($this->getSeat())) {
            return 'No seat assignment.';
        }
        $labels = [
            self::TRANSPORTATION_BUS      => 'Sit in seat %(seat).',
            self::TRANSPORTATION_AIRPLANE => '%(seat).',
            self::TRANSPORTATION_TRAIN    => 'Sit in seat %(seat).',
        ];

        $formattedLabel = $labels[ $this->getTransportationType() ];

        $map = [
            '%(seat)' => $this->getSeat(),
        ];

        return strtr($formattedLabel, $map);
    }
}
