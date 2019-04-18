<?php

namespace Freyo\MtaH5\Kernel\Providers;

use Freyo\MtaH5\Kernel\BaseClient;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class BaseClientServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['base_client'] = function ($app) {
            return new BaseClient($app);
        };
    }
}
