<?php

namespace Fsrestapi\Utils;

use Phalcon\Http\Response;

class ResponseCreator
{
    public static function create($code = 200, $content = null)
    {
        $response = new Response();
        $response->setStatusCode($code);
        $response->setJsonContent(json_encode($content));
        return $response;
    }

    public static function createNotFound()
    {
        return  self::create(404, array('message' => 'File was not found in the working directory!'));
    }

    public static function createOK($content = null)
    {
        return self::create(200, $content);
    }

    public static function createUnauthorizedAccess()
    {
        return self::create(401, array('message' => 'Unauthorized access!'));
    }
}