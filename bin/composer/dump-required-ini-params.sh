#!/usr/bin/env php
<?php

/*
 * This should be run in the VM in order to dump required INI configuration values to a YAML parameter file that
 * can be used by Symfony
 */

$currentPath  = realpath(__DIR__);
$projectRoot  = $currentPath . '/../../';
$autoloadPath = $projectRoot . 'vendor/autoload.php';
$ymlDumpPath  = $projectRoot . 'app/config/ini_parameters.yml';

require_once($autoloadPath);

$loader     = new OpenConext\EngineBlockBridge\Configuration\EngineBlockIniFileLoader();
$iniContent = $loader->load(
    array(
        $projectRoot . 'application/' . EngineBlock_Application_Bootstrapper::CONFIG_FILE_DEFAULT,
        EngineBlock_Application_Bootstrapper::CONFIG_FILE_ENVIRONMENT,
    )
);

$config = new \OpenConext\EngineBlockBridge\Configuration\EngineBlockConfiguration($iniContent);

$ymlContent = array(
    'parameters' => array(
        'domain'                                                  => $config->get('base_domain'),
        'trusted_proxies'                                         => $config->get('trustedProxyIps', array())->toArray(),
        'api.users.janus.username'                                => $config->get('engineApi.users.janus.username'),
        'api.users.janus.password'                                => $config->get('engineApi.users.janus.password'),
        'api.users.profile.username'                              => $config->get('engineApi.users.profile.username'),
        'api.users.profile.password'                              => $config->get('engineApi.users.profile.password'),
        'logger.channel'                                          => $config->get('logger.conf.name'),
        'logger.fingers_crossed.passthru_level'                   => $config->get(
            'logger.conf.handler.fingers_crossed.conf.passthru_level'
        ),
        'logger.syslog.ident'                                     => $config->get('logger.conf.handler.syslog.conf.ident'),
        'database.host'                                           => $config->get('database.host'),
        'database.port'                                           => $config->get('database.port'),
        'database.user'                                           => $config->get('database.user'),
        'database.password'                                       => $config->get('database.password'),
        'database.dbname'                                         => $config->get('database.dbname'),
        'feature_eb_ldap_integration'                             => (bool) $config->get('engineblock.feature.ldap_integration'),
        'feature_eb_encrypted_assertions'                         => (bool) $config->get('engineblock.feature.encrypted_assertions'),
        'feature_eb_encrypted_assertions_require_outer_signature' => (bool) $config->get('engineblock.feature.encrypted_assertions_require_outer_signature'),
        'feature_api_metadata_push'                               => (bool) $config->get('engineApi.features.metadataPush'),
        'feature_api_consent_listing'                             => (bool) $config->get('engineApi.features.consentListing'),
        'feature_api_metadata_api'                                => (bool) $config->get('engineApi.features.metadataApi'),
    )
);

$ymlToDump = \Symfony\Component\Yaml\Yaml::dump($ymlContent);

$comment = "# This file is auto-generated" . PHP_EOL;

$writer = new \Symfony\Component\Filesystem\Filesystem();
$writer->dumpFile($ymlDumpPath, $comment . $ymlToDump, 0664);
