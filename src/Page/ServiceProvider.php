<?php

namespace Freyo\MtaH5\Page;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['page'] = function ($app) {
            return new Client($app);
        };
    }
}
