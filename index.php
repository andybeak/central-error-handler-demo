<?php

require('vendor/autoload.php');

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Rollbar\Rollbar;

Rollbar::init(
    [
        'access_token' => '<obtain from your Rollbar project settings>',
        'environment' => 'development'
    ]
);

$rollbarLogger = Rollbar::logger();

// create a log channel
$log = new Logger('general');
$rollbarHandler = new \Monolog\Handler\RollbarHandler($rollbarLogger);
$log->pushHandler($rollbarHandler, Logger::DEBUG);
$log->pushHandler(new StreamHandler(__DIR__ . '/log/application.log', Logger::DEBUG));

function exception_handler(Throwable $e) {

    if (get_class($e) === \App\Exceptions\DemoLibraryException::class) {
        http_response_code($e->httpStatus ?? 500);
        echo $e->getMessage() . ".  Please contact support and quote this reference [{$e->errorId}]";
    } else {
        echo "An unexpected error occurred";
    }
}

set_exception_handler('exception_handler');

$example = (new \App\ExampleClass())->setLogger($log);
$example->exampleMethod(-1);