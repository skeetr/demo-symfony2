<?php
use Skeetr\Debugger;
use Skeetr\Client;
use Skeetr\Gearman\Worker;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Skeetr\Client\Handler\Error;

require_once __DIR__ . '/../app/bootstrap.php.cache';
require_once __DIR__ . '/../app/AppKernel.php';
//require_once __DIR__.'/../app/bootstrap_cache.php.cache';
//require_once __DIR__.'/../app/AppCache.php';

//$kernel = new AppCache(new AppKernel('prod', false));


$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();

$logger = new Logger('debugger');
$logger->pushHandler(new StreamHandler('php://stdout', Logger::INFO));

Error::register();
Error::setLogger($logger);

$debugger = new Debugger($logger);
$debugger->run();

$worker = new Worker();
$worker->addServer('front-1.iunait.es', 4730);

$client = new Client($logger, $worker);
$client->setCallback(function($request, $response) use ($kernel, $logger) { 
    return $kernel->handle(Request::createFromGlobals())->getContent();
});


$client->work();