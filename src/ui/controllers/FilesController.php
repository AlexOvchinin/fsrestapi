<?php

use Phalcon\Mvc\Controller;

use Fsrestapi\Config;

class FilesController extends Controller
{
    public function indexAction()
    {
        $items = array();

        $dirPath = Config::getDirectory();
        if ($dirHandle = opendir($dirPath)) {
            $fileName = readdir($dirHandle);

            while ($fileName) {
                $filePath = $dirPath . "\\" . $fileName;

                if (is_dir($filePath) == false) {
                    array_push($items, $fileName);
                }

                $fileName = readdir($dirHandle);
            }
        }


        $this->view->setVar('items', $items);
        $this->view->setVar('result', $items);
    }

    public function deleteFile($param)
    {
    }
}
