<?php

namespace Freyo\MtaH5\AdTag;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['adtag'] = function ($app) {
            return new Client($app);
        };
    }
}