<?php

namespace Freyo\MtaH5\Trend;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['trend'] = function ($app) {
            return new Client($app);
        };
    }
}