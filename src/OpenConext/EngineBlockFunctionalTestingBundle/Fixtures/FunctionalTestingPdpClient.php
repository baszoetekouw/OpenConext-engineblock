<?php

/**
 * Copyright 2017 SURFnet B.V.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace OpenConext\EngineBlockFunctionalTestingBundle\Fixtures;

use OpenConext\EngineBlockBundle\Pdp\Dto\Request;
use OpenConext\EngineBlockBundle\Pdp\Dto\Response;
use OpenConext\EngineBlockBundle\Pdp\Dto\Response\AssociatedAdvice;
use OpenConext\EngineBlockBundle\Pdp\Dto\Response\AttributeAssignment;
use OpenConext\EngineBlockBundle\Pdp\Dto\Response\Status;
use OpenConext\EngineBlockBundle\Pdp\Dto\Response\StatusCode;
use OpenConext\EngineBlockBundle\Pdp\PdpClientInterface;
use OpenConext\EngineBlockBundle\Pdp\PolicyDecision;
use OpenConext\EngineBlockFunctionalTestingBundle\Exception\RuntimeException;
use OpenConext\EngineBlockFunctionalTestingBundle\Fixtures\DataStore\AbstractDataStore;

final class FunctionalTestingPdpClient implements PdpClientInterface
{
    /**
     * @var AbstractDataStore
     */
    private $dataStore;

    /**
     * @var string
     */
    private $policyDecisionFixture;

    public function __construct(AbstractDataStore $dataStore)
    {
        $this->dataStore = $dataStore;
        $this->policyDecisionFixture = $dataStore->load();
    }

    /**
     * @param Request $request
     * @return PolicyDecision $policyDecision
     */
    public function requestDecisionFor(Request $request)
    {
        $pdpResponse = new Response();

        switch ($this->policyDecisionFixture) {
            case PolicyDecision::DECISION_DENY:
                $pdpResponse->decision = PolicyDecision::DECISION_DENY;

                $englishDenyMessage = new AttributeAssignment();
                $englishDenyMessage->attributeId = 'DenyMessage:en';
                $englishDenyMessage->value = 'Students do not have access to this resource';
                $dutchDenyMessage = new AttributeAssignment();
                $dutchDenyMessage->attributeId = 'DenyMessage:nl';
                $dutchDenyMessage->value = 'Studenten hebben geen toegang tot deze dienst';

                $associatedAdvice = new AssociatedAdvice();
                $associatedAdvice->attributeAssignments = [$englishDenyMessage, $dutchDenyMessage];
                $pdpResponse->associatedAdvices = [$associatedAdvice];
                break;
            case PolicyDecision::DECISION_INDETERMINATE:
                $pdpResponse->decision = PolicyDecision::DECISION_INDETERMINATE;

                $pdpResponse->status = new Status();
                $pdpResponse->status->statusDetail = <<<XML
    <MissingAttributeDetail 
        Category="urn:oasis:names:tc:xacml:1.0:subject-category:access-subject"
        AttributeId="urn:mace:dir:attribute-def:eduPersonAffiliation"
        DataType="http://www.w3.org/2001/XMLSchema#string"/>
XML;
                $pdpResponse->status->statusCode = new StatusCode();
                $pdpResponse->status->statusCode->value = 'urn:oasis:names:tc:xacml:1.0:status:missing-attribute';
                $pdpResponse->status->statusMessage = 'Missing required attribute';
                break;
            case PolicyDecision::DECISION_NOT_APPLICABLE:
                $pdpResponse->decision = PolicyDecision::DECISION_NOT_APPLICABLE;
                break;
            case PolicyDecision::DECISION_PERMIT:
                $pdpResponse->decision = PolicyDecision::DECISION_PERMIT;
                break;
            default:
                $invalidData = $this->policyDecisionFixture;
                if (!is_string($invalidData)) {
                    $invalidData = is_object($invalidData) ? get_class($invalidData) : gettype($invalidData);
                }

                throw new RuntimeException(
                    sprintf(
                        'Invalid Policy Decision fixture given: expected one of %s, got: %s',
                        implode(
                            ', ',
                            [
                                PolicyDecision::DECISION_DENY,
                                PolicyDecision::DECISION_INDETERMINATE,
                                PolicyDecision::DECISION_NOT_APPLICABLE,
                                PolicyDecision::DECISION_PERMIT,
                            ]
                        ),
                        $invalidData
                    )
                );
        }

        return PolicyDecision::fromResponse($pdpResponse);
    }

    public function receiveDenyResponse()
    {
        $this->dataStore->save(PolicyDecision::DECISION_DENY);
    }

    public function receiveIndeterminateResponse()
    {
        $this->dataStore->save(PolicyDecision::DECISION_INDETERMINATE);
    }

    public function receivePermitResponse()
    {
        $this->dataStore->save(PolicyDecision::DECISION_PERMIT);
    }

    public function receiveNotApplicableResponse()
    {
        $this->dataStore->save(PolicyDecision::DECISION_NOT_APPLICABLE);
    }

    public function clear()
    {
        $this->dataStore->save(null);
    }
}
