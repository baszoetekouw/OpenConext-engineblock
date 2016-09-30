<?php

namespace OpenConext\EngineBlockBundle\Metadata\Repository;

use OpenConext\EngineBlock\Metadata\Model\IdentityProvider;
use OpenConext\EngineBlock\Metadata\Model\ServiceProvider;

class InMemorySamlServiceRepository
{
    /**
     * @var (ServiceProvider|IdentityProvider)[]array
     */
    private $samlEntities = [];

    /**
     * @var ServiceProvider[]
     */
    private $serviceProviders = [];

    /**
     * @var IdentityProvider[]
     */
    private $identityProviders = [];

    /**
     * @param ServiceProvider $serviceProvider
     */
    public function addServiceProvider(ServiceProvider $serviceProvider)
    {
        $this->samlEntities[]     = $serviceProvider;
        $this->serviceProviders[] = $serviceProvider;
    }

    /**
     * @param ServiceProvider $identityProvider
     */
    public function addIdentityProvider(ServiceProvider $identityProvider)
    {
        $this->samlEntities[]      = $identityProvider;
        $this->identityProviders[] = $identityProvider;
    }
}
