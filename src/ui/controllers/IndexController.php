<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->dispatcher->forward(
            array(
                'controller' => 'Login',
                'action' => 'index'
            )
        );
    }
}
