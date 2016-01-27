<?php

namespace OpenConext\EngineBlock\Authentication\Entity;

use DateTime;
use OpenConext\EngineBlock\Authentication\Exception\InvalidArgumentException;
use OpenConext\EngineBlock\Authentication\Value\ConsentType;

final class Consent
{
    /**
     * The NameID of the user.
     *
     * @var string
     */
    private $userId;

    /**
     * The entity ID of the service.
     *
     * @var string
     */
    private $serviceProviderEntityId;

    /**
     * @var DateTime
     */
    private $consentGivenOn;

    /**
     * @var DateTime
     */
    private $lastUsedOn;

    /**
     * @var ConsentType
     */
    private $consentType;

    /**
     * @param string $userId
     * @param string $serviceProviderEntityId
     * @param DateTime $consentGivenOn
     * @param DateTime $lastUsedOn
     * @param ConsentType $consentType
     */
    public function __construct(
        $userId,
        $serviceProviderEntityId,
        DateTime $consentGivenOn,
        DateTime $lastUsedOn,
        ConsentType $consentType
    ) {
        if (!is_string($userId)) {
            throw InvalidArgumentException::invalidType('string', 'userId', $userId);
        }

        if (!is_string($serviceProviderEntityId)) {
            throw InvalidArgumentException::invalidType('string', 'serviceProviderEntityId', $serviceProviderEntityId);
        }

        $this->userId                  = $userId;
        $this->serviceProviderEntityId = $serviceProviderEntityId;
        $this->consentGivenOn          = $consentGivenOn;
        $this->lastUsedOn              = $lastUsedOn;
        $this->consentType             = $consentType;
    }

    /**
     * The entity ID of the service.
     *
     * @return string
     */
    public function getServiceProviderEntityId()
    {
        return $this->serviceProviderEntityId;
    }

    /**
     * @return DateTime
     */
    public function getDateConsentWasGivenOn()
    {
        return clone $this->consentGivenOn;
    }

    /**
     * @return DateTime
     */
    public function getDateLastUsedOn()
    {
        return clone $this->lastUsedOn;
    }

    /**
     * @return ConsentType
     */
    public function getConsentType()
    {
        return $this->consentType;
    }
}