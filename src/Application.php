<?php

namespace Freyo\MtaH5;

use Closure;
use Freyo\MtaH5\Kernel\ServiceContainer;

/**
 * @property Trend\Client  $trend
 * @property User\Client   $user
 * @property Device\Client $device
 * @property Page\Client   $page
 * @property Custom\Client $custom
 * @property Source\Client $source
 * @property AdTag\Client  $adtag
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Trend\ServiceProvider::class,
        User\ServiceProvider::class,
        Device\ServiceProvider::class,
        Page\ServiceProvider::class,
        Custom\ServiceProvider::class,
        Source\ServiceProvider::class,
        AdTag\ServiceProvider::class,
    ];
}