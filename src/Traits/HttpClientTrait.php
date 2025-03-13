<?php

/*
 * This file is part of the pkg6/cloud-print.
 *
 * (c) pkg6 <https://github.com/pkg6>
 *
 * (L) Licensed <https://opensource.org/license/MIT>
 *
 * (A) zhiqiang <https://www.zhiqiang.wang>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Pkg6\CloudPrint\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait HttpClientTrait
{
    /**
     * @var array
     */
    protected $guzzleConfig = [
        'headers' => [
            'User-Agent' => 'cloud-print (https://github.com/pkg6/cloud-print)',
        ]
    ];

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return string
     *
     * @throws GuzzleException
     */
    protected function httpGet(string $url, array $query = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'query' => $query,
        ];

        return $this->httpRequest('GET', $url, $options);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     *
     * @return string
     *
     * @throws GuzzleException
     */
    protected function httpPost(string $url, array $params = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'form_params' => $params,
        ];

        return $this->httpRequest('POST', $url, $options);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     *
     * @return string
     *
     * @throws GuzzleException
     */
    protected function httpPostJson(string $url, array $params = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'json' => $params,
        ];

        return $this->httpRequest('POST', $url, $options);
    }

    /**
     * @param $method
     * @param $url
     * @param $options
     *
     * @return string
     *
     * @throws GuzzleException
     */
    protected function httpRequest($method, $url, $options)
    {
        $resp = $this->httpClient()->request($method, $url, $options);

        return $resp->getBody()->getContents();
    }

    /**
     * @return Client
     */
    protected function httpClient()
    {
        if ( ! class_exists(Client::class)) {
            throw new \RuntimeException('Not installed guzzlehttp/guzzle');
        }

        return new Client(array_merge($this->config['http'], $this->guzzleConfig));
    }
}
