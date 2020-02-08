<?php

namespace Hisway\SuningClient;

use Hisway\SuningClient\Factories\SuningClientFactory;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class SuningClientManager extends AbstractManager
{
    protected $factory;

    public function __construct(Repository $config, SuningClientFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    protected function getConfigName()
    {
        return 'suning';
    }

    public function getFactory()
    {
        return $this->factory;
    }
}