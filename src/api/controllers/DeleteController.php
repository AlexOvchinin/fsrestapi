<?php

namespace Fsrestapi\Api\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

use Fsrestapi\Config;
use Fsrestapi\Utils\File;
use Fsrestapi\Utils\ResponseCreator;

class DeleteController extends Controller
{
    use AuthTrait;

    public function deleteAction($path)
    {
        if (!$this->checkAuth($this->request)) {
            return ResponseCreator::createUnauthorizedAccess();
        }

        $fullPath = Config::getDirectory() . '/' . $path;

        if (!Path::exists($fullPath)) {
            return ResponseCreator::createNotFound();
        }

        File::delete($fullPath);

        return ResponseCreator::createOK(array('message' => 'File was deleted successfully.'));
    }
}
