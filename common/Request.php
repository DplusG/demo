<?php
/**
 * Created by PhpStorm.
 * User: ִלטענטי
 * Date: 14.09.2019
 * Time: 12:54
 */

namespace app\common;

use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request extends GuzzleRequest
{
    private $token = 'test';

    const TEST = true;

    public function __construct($method,
        $uri,
        array $headers = [],
        $body = null,
        $version = '1.1'
    ) {
        $headers = array_merge([], $headers, ['Authorization' => 'Bearer ' . $this->token]);

        if(TEST) {
            $method = 'GET';
            $uri = 'https://www.yandex.ru/search/?text='.$body;
        }

        parent::__construct($method, $uri, $headers, $body, $version);
    }

}