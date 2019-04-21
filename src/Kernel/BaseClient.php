<?php

namespace Freyo\MtaH5\Kernel;

use Freyo\MtaH5\Kernel\Http\Response;
use Freyo\MtaH5\Kernel\Traits\HasHttpRequests;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;
use function Freyo\MtaH5\Kernel\Support\generate_sign;

class BaseClient
{
    use HasHttpRequests {
        request as performRequest;
    }

    /**
     * @var \Freyo\MtaH5\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * BaseClient constructor.
     *
     * @param \Freyo\MtaH5\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
        $this->baseUri = $this->getBaseUri();

        $this->setHttpClient($this->app['http_client']);
    }

    /**
     * GET request.
     *
     * @param string $url
     * @param array  $query
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Freyo\MtaH5\Kernel\Support\Collection|array|object|string
     */
    public function httpGet($url, array $query = [])
    {
        $query['app_id'] = $this->app->getAppId();
        $query['sign'] = generate_sign($query, $this->app->getSecretKey());

        return $this->request($url, 'GET', ['query' => $query]);
    }

    /**
     * POST request.
     *
     * @param string $url
     * @param array  $data
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Freyo\MtaH5\Kernel\Support\Collection|array|object|string
     */
    public function httpPost($url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    /**
     * JSON request.
     *
     * @param string       $url
     * @param string|array $data
     * @param array        $query
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Freyo\MtaH5\Kernel\Support\Collection|array|object|string
     */
    public function httpPostJson($url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }

    /**
     * Upload file.
     *
     * @param string $url
     * @param array  $files
     * @param array  $form
     * @param array  $query
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Freyo\MtaH5\Kernel\Support\Collection|array|object|string
     */
    public function httpUpload($url, array $files = [], array $form = [], array $query = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request($url, 'POST', ['query' => $query, 'multipart' => $multipart, 'connect_timeout' => 30, 'timeout' => 30, 'read_timeout' => 30]);
    }

    /**
     * Make a request and return raw response.
     *
     * @param string $url
     * @param string $method
     * @param array  $options
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return ResponseInterface
     */
    public function requestRaw($url, $method = 'GET', array $options = [])
    {
        return Response::buildFromPsrResponse($this->request($url, $method, $options, true));
    }

    /**
     * Make a API request.
     *
     * @param string $url
     * @param string $method
     * @param array  $options
     * @param bool   $returnRaw
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Freyo\MtaH5\Kernel\Support\Collection|array|object|string
     */
    public function request($url, $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    /**
     * Register Guzzle middlewares.
     */
    protected function registerHttpMiddlewares()
    {
        // log
        $this->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * Log the request.
     *
     * @return \Closure
     */
    protected function logMiddleware()
    {
        $formatter = new MessageFormatter($this->app['config']->get('http.log_template', MessageFormatter::DEBUG));

        return Middleware::log($this->app['logger'], $formatter);
    }

    /**
     * Extra request params.
     *
     * @return array
     */
    protected function prepends()
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getBaseUri()
    {
        return $this->app['config']->get('http.base_uri');
    }

    /**
     * Wrapping an API endpoint.
     *
     * @param string $endpoint
     * @param string $prefix
     *
     * @return string
     */
    protected function wrap($endpoint, $prefix = '')
    {
        return implode('/', [$prefix, $endpoint]);
    }
}
