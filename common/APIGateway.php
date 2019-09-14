<?php
/**
 * Created by PhpStorm.
 * User: ִלטענטי
 * Date: 14.09.2019
 * Time: 12:27
 */

namespace app\common;

class APIGateway
{
    public static function send($request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->send($request, ['timeout' => 10]);
        return $response->getStatusCode() == 200 ? true : false;
    }
}