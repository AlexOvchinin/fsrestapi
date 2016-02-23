<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Db\Column;

use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

use Fsrestapi\Api\Cache\CacheService;

// initialize loader
$loader = new Loader();

$loader->registerNamespaces(
    array(
        'Fsrestapi\Api\Controllers' => __DIR__ . '/src/controllers/'
    )
);

$loader->registerDirs(array(
    __DIR__ . '/ui/controllers/',
    __DIR__ . '/models',
    __DIR__ . '/ui/views/'
));

$loader->register();

$di = new FactoryDefault();

//setup view
$di->set('view', function () {
    $view = new View();
    $view->setViewsDir(__DIR__ . '/ui/views');
    $view->registerEngines(
        array(
            '.volt' => 'Phalcon\Mvc\View\Engine\Volt'
        )
    );

    return $view;
});

// url beatifier
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('');
    return $url;
});

// setting up database connection

$connection = new DbAdapter(
    array(
        'host' => 'localhost',
        'dbname' => 'fsrestapi',
        'username' => 'admin',
        'password' => 'admin'
    )
);

$di->set('db', $connection);

if (!$connection->tableExists('users')) {
    $connection->createTable(
        'users',
        null,
        array(
            'columns' => array(
                new Column(
                    'id',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'primary' => true
                    )
                ),
                new Column(
                    'username',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'notNull' => true
                    )
                ),
                new Column(
                    'password',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'notNull' => true
                    )
                )
            )
        )
    );

    $user = new Users();
    $user->username = 'user';
    $user->password = 'user';
    $user->save();
}

if (!$connection->tableExists('responses')) {
    $connection->createTable(
        'responses',
        null,
        array(
            'columns' => array(
                new Column(
                    'path',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'notNull' => true,
                        'primary' => true
                    )
                ),
                new Column(
                    'timestamp',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 45,
                        'notNull' => true
                    )
                ),
                new Column(
                    'value',
                    array(
                        'type' => Column::TYPE_MEDIUMBLOB,
                        'notNull' => true
                    )
                )
            )
        )
    );
}

// creating app
$application = new Application($di);

$router = $di->getShared('router');
$router->setUriSource(true);

//setting up api routines
$router->addGet(
    '/api/{path}',
    array(
        'namespace' => 'Fsrestapi\Api\Controllers',
        'controller' => 'get',
        'action' => 'get'
    )
);

$router->addGet(
    '/api/metadata/{path}',
    array(
        'namespace' => 'Fsrestapi\Api\Controllers',
        'controller' => 'get',
        'action' => 'getMetadata'
    )
);

$router->add(
    '/api/{path}',
    array(
        'namespace' => 'Fsrestapi\Api\Controllers',
        'controller' => 'put',
        'action' => 'put'
    )
)->via(array('POST', 'PUT'));

$router->addDelete(
    '/api/{path',
    array(
        'namespace' => 'Fsrestapi\Api\Controllers',
        'controller' => 'delete',
        'action' => 'delete'
    )
);

//create cache service
$cacheService = new CacheService();
$di->setShared('fsrestapi:cache', $cacheService);

return $application;
