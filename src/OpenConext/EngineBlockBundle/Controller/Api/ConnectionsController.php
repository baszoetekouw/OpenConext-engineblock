<?php

namespace OpenConext\EngineBlockBundle\Controller\Api;

use EngineBlock_ApplicationSingleton;
use OpenConext\EngineBlockBundle\Metadata\Service\MetadataConnectionsFactory;
use OpenConext\Component\EngineBlockMetadata\Entity\Assembler\JanusPushMetadataAssembler;
use OpenConext\Component\EngineBlockMetadata\MetadataRepository\DoctrineMetadataRepository;
use OpenConext\EngineBlockBundle\Configuration\FeatureConfiguration;
use OpenConext\EngineBlockBundle\Http\Exception\ApiAccessDeniedHttpException;
use OpenConext\EngineBlockBundle\Http\Exception\BadApiRequestHttpException;
use OpenConext\EngineBlockBundle\Http\Request\JsonRequestHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ConnectionsController
{
    /**
     * @var EngineBlock_ApplicationSingleton
     */
    private $engineBlockApplicationSingleton;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var FeatureConfiguration
     */
    private $featureConfiguration;

    /**
     * @param AuthorizationCheckerInterface    $authorizationChecker
     * @param FeatureConfiguration             $featureConfiguration
     * @param EngineBlock_ApplicationSingleton $engineBlockApplicationSingleton
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        FeatureConfiguration $featureConfiguration,
        EngineBlock_ApplicationSingleton $engineBlockApplicationSingleton
    ) {
        $this->engineBlockApplicationSingleton = $engineBlockApplicationSingleton;
        $this->authorizationChecker            = $authorizationChecker;
        $this->featureConfiguration            = $featureConfiguration;
    }

    public function pushConnectionsAction(Request $request)
    {
//file_put_contents('../pushed_connections.json', $request->getContent());

        if (!$this->featureConfiguration->isEnabled('api.metadata_push')) {
            return new JsonResponse(null, 404);
        }

        if (!$this->authorizationChecker->isGranted(['ROLE_API_USER_JANUS'])) {
            throw new ApiAccessDeniedHttpException();
        }

        ini_set('memory_limit', '265M');

        $requestData = JsonRequestHelper::decodeContentOf($request);

        if (!isset($requestData['connections']) || !is_array($requestData['connections'])) {
            throw new BadApiRequestHttpException('Unrecognized structure for JSON');
        }

//file_put_contents('../pushed_connections.json', json_encode($requestData, JSON_PRETTY_PRINT));

        $connections = MetadataConnectionsFactory::createConnectionsFrom($requestData['connections']);

        //        $assembler = new JanusPushMetadataAssembler();
        //        $roles     = $assembler->assemble($body->connections);

        //        $diContainer = $this->engineBlockApplicationSingleton->getDiContainer();
        //        $doctrineRepository = DoctrineMetadataRepository::createFromConfig([], $diContainer);
        //
        //        $result = $doctrineRepository->synchronize($roles);
        //
        //        return new JsonResponse($result);
file_put_contents('../exported_connections', '<?php ' . PHP_EOL . var_export($connections, true) . ';');
    }
}
