<?php

namespace Freyo\MtaH5\Device;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['device'] = function ($app) {
            return new Client($app);
        };
    }
}
