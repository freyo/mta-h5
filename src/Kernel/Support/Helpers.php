<?php

namespace Freyo\MtaH5\Kernel\Support;

/**
 * Generate a signature.
 *
 * @param array $params
 * @param string $secretKey
 *
 * @return string
 */
function generate_sign(array $params, $secretKey)
{
    ksort($params);

    foreach ($params as $key => $value) {
        $secretKey .= $key . '=' . $value;
    }

    return md5($secretKey);
}

/**
 * Get client ip.
 *
 * @return string
 */
function get_client_ip()
{
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        // for php-cli(phpunit etc.)
        $ip = defined('PHPUNIT_RUNNING') ? '127.0.0.1' : gethostbyname(gethostname());
    }

    return filter_var($ip, FILTER_VALIDATE_IP) ?: '127.0.0.1';
}

/**
 * Get current server ip.
 *
 * @return string
 */
function get_server_ip()
{
    if (!empty($_SERVER['SERVER_ADDR'])) {
        $ip = $_SERVER['SERVER_ADDR'];
    } elseif (!empty($_SERVER['SERVER_NAME'])) {
        $ip = gethostbyname($_SERVER['SERVER_NAME']);
    } else {
        // for php-cli(phpunit etc.)
        $ip = defined('PHPUNIT_RUNNING') ? '127.0.0.1' : gethostbyname(gethostname());
    }

    return filter_var($ip, FILTER_VALIDATE_IP) ?: '127.0.0.1';
}

/**
 * Return current url.
 *
 * @return string
 */
function current_url()
{
    $protocol = 'http://';

    if ((!empty($_SERVER['HTTPS']) && 'off' !== $_SERVER['HTTPS']) ||
        (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : 'http') === 'https') {
        $protocol = 'https://';
    }

    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Return random string.
 *
 * @param string $length
 *
 * @return string
 */
function str_random($length)
{
    return Str::random($length);
}

/**
 * @param string $content
 * @param string $publicKey
 *
 * @return string
 */
function rsa_public_encrypt($content, $publicKey)
{
    $encrypted = '';
    openssl_public_encrypt($content, $encrypted, openssl_pkey_get_public($publicKey), OPENSSL_PKCS1_OAEP_PADDING);

    return base64_encode($encrypted);
}
