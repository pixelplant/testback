<?php

namespace BackendTest\Transportation;

class BusCard extends Card
{
    /**
     * Return the formatted route fur bus rides
     *
     * @return string
     */
    public function formatRoute()
    {
        $seat       = ($this->getSeat()) ? 'Sit in seat ' . $this->getSeat() : 'No seat assignment.';
        $connection = ($this->getConnectionName()) ? 'Take the bus ' . $this->getConnectionName() : 'Take the bus';

        return sprintf(
            $connection . " from %s to %s. %s",
            $this->getFrom(),
            $this->getTo(),
            $seat
        );
    }
}
