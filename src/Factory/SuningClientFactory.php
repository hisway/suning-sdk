<?php

namespace Hisway\SuningClient\Factories;

use SuningClient\SuningClient;

class SuningClientFactory
{
    /**
     * Make a new suningclient client.
     *
     * @param string[] $config
     *
     * @return SuningClient
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);
        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @return string[]
     * @throws \InvalidArgumentException
     *
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('app_key', $config)
            || !array_key_exists('app_secret', $config)) {
            throw new \InvalidArgumentException('The suning client requires api keys.');
        }
        return $config;
    }

    /**
     * Get the suningclient client.
     *
     * @param array $config
     * @return SuningClient
     */
    protected function getClient(array $config)
    {
        $c = new SuningClient;
        $c->setAppKey($config['app_key']);
        $c->setAppSecret($config['app_secret']);
        $c->setFormat(isset($config['format']) ? $config['format'] : 'json');
        $c->setServerUrl(isset($config['server_url']) ? $config['server_url'] : 'https://open.suning.com/api/http/sopRequest');
        return $c;
    }
}