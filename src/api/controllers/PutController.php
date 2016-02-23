<?php

namespace Fsrestapi\Api\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\Request;

use Fsrestapi\Config;
use Fsrestapi\Utils\File;
use Fsrestapi\Utils\ResponseCreator;

class PutController extends Controller
{
    use AuthTrait;

    public function putAction($path)
    {
        if (!$this->checkAuth($this->request)) {
            return ResponseCreator::createUnauthorizedAccess();
        }

        $fullPath = Config::getDirectory() . '/' . $path;

        $request = $this->request;

        $content = $request->getRawBody();

        File::setContent($fullPath, $content);
    }
}
