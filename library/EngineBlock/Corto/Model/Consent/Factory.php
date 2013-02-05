<?php
class EngineBlock_Corto_Model_Consent_Factory
{
    /** @var EngineBlock_Corto_Filter_Command_Factory */
    private $_filterCommandFactory;


    public function __construct(EngineBlock_Corto_Filter_Command_Factory $filterCommandFactory)
    {
        $this->_filterCommandFactory = $filterCommandFactory;
    }

    /**
     * Creates a new Consent instance
     *
     * @param EngineBlock_Corto_ProxyServer $proxyServer
     * @param array $response
     * @param array $attributes
     * @return EngineBlock_Corto_Model_Consent
     */
    public function create(EngineBlock_Corto_ProxyServer $proxyServer, array $response, array $attributes) {
        return new EngineBlock_Corto_Model_Consent(
            $proxyServer->getConfig('ConsentDbTable', 'consent'),
            $proxyServer->getConfig('ConsentStoreValues', true),
            $response,
            $attributes,
            $this->_filterCommandFactory
        );
    }
}
