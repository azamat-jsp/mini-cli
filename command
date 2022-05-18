#!/usr/bin/php
<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Minicli\App;

$app = new App();
$redisInit = new \Minicli\RedisClient();

$app->registerCommand('redis', function (array $argv) use ($app, $redisInit) {
    if (isset($argv[2]) && $argv[2] === 'add') {
        if (isset($argv[3]) && isset($argv[4])) {
            $client = $redisInit->getClient();
            $client->set($argv[3], $argv[4]);
            $bar = $client->get($argv[3]);
            $app->getPrinter()->display("redis: add $argv[3] - $bar");
        }

    }
    elseif(isset($argv[2]) && $argv[2] === 'delete') {
        if (isset($argv[3])) {
            $client = $redisInit->getClient();
            $client->del($argv[3]);
            $app->getPrinter()->display("redis: delete $argv[3]");
        }
    }
    else {
        $client = $redisInit->getClient();
        print_r($client->keys('*'));
        $app->getPrinter()->display("redis: command not found");
    }
});


$app->runCommand($argv);