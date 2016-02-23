<?php

namespace Fsrestapi\Api\Cache;


class CacheService
{
    public function cache($path, $timestamp, $value)
    {
        $response = new \Responses();
        $response->path = $path;
        $response->timestamp = $timestamp;
        $response->value = $value;

        $response->save();
    }

    public function isCached($path)
    {
        $response = $this->getCachedResponse($path);
        return $response != false;
    }

    public function getCachedResponse($path)
    {
        return \Responses::findFirst(
            array(
                "path = :path:",
                'bind' => array(
                    'path'    => $path
                )
            )
        );
    }
}