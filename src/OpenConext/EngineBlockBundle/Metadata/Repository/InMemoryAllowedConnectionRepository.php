<?php

namespace OpenConext\EngineBlockBundle\Metadata\Repository;

use OpenConext\EngineBlockBundle\Metadata\Entity\AllowedConnection;

class InMemoryAllowedConnectionRepository
{
    /**
     * @var AllowedConnection[]
     */
    private $connections = [];

    /**
     * @param AllowedConnection $connection
     */
    public function saveConnection(AllowedConnection $connection)
    {
        $this->connections[] = $connection;
    }

    /**
     * @return \OpenConext\EngineBlockBundle\Metadata\Entity\AllowedConnection[]
     */
    public function getConnections()
    {
        return $this->connections;
    }
}
