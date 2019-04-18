<?php

namespace Freyo\MtaH5\Source;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['source'] = function ($app) {
            return new Client($app);
        };
    }
}