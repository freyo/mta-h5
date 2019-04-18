<?php

namespace Freyo\MtaH5\User;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['user'] = function ($app) {
            return new Client($app);
        };
    }
}