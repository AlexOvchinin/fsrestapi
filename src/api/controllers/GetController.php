<?php

namespace Fsrestapi\Api\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

use Fsrestapi\Config;
use Fsrestapi\Utils\File;
use Fsrestapi\Utils\ResponseCreator;

class GetController extends Controller
{
    use AuthTrait;

    protected function getMethod()
    {
        return 'GET';
    }

    public function getAction($path)
    {
        if (!$this->checkAuth($this->request)) {
            return ResponseCreator::createUnauthorizedAccess();
        }

        $fullPath = Config::getDirectory() . '/' . $path;

        if (!File::exists($fullPath)) {
            return ResponseCreator::createNotFound();
        }

        $lastModificationTime = File::getMetadata($fullPath)['lastModificationTime'];

        $cachePath  = $this->getMethod() . '/' . $path;

        $cache = $this->getDI()->getShared('fsrestapi:cache');
        if ($cache->isCached($cachePath)) {
            $cachedResponse = $cache->getCachedResponse($cachePath);

            if ($lastModificationTime == $cachedResponse->timestamp) {
                $response = ResponseCreator::createOK();
                $response->setContent($cachedResponse->value);
                return $response;
            }
        }

        $fileContent = File::getContent($fullPath);

        $response = ResponseCreator::createOK(array('content' => $fileContent));

        $cache->cache($cachePath, $lastModificationTime, $response->getContent());
        return $response;
    }

    public function getMetadataAction($path)
    {
        if (!$this->checkAuth($this->request)) {
            return ResponseCreator::createUnauthorizedAccess();
        }

        $fullPath = Config::getDirectory() . '/' . $path;

        if (!File::exists($fullPath)) {
            return ResponseCreator::createNotFound();
        }

        $metadata = File::getMetadata($fullPath);
        $lastModificationTime = $metadata['lastModificationTime'];

        $cachePath  = $this->getMethod() . $path;

        $cache = $this->getDI()->getShared('fsrestapi:cache');
        if ($cache->isCached($cachePath)) {
            $cachedResponse = $cache->getCachedResponse($cachePath);

            if ($lastModificationTime == $cachedResponse->timestamp) {
                $response = ResponseCreator::createOK();
                $response->setContent($cachedResponse->value);
                return $response;
            }
        }

        $response = ResponseCreator::createOK(array('metadata' => $metadata));
        $cache->cache($cachePath, $lastModificationTime, $response->getContent());

        return $response;
    }
}
