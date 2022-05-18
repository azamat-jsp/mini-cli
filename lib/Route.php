<?php

namespace Minicli;

use App\Controllers\Api\RedisController;

class Route
{
    public function __construct()
    {
    }

    public function run()
    {
        $key = null;
        $request_uri = $_SERVER['REQUEST_URI'];
        $argv = explode( '/', $request_uri);

        if (isset($argv[3])) {
            $key = $argv[3];
        }

        $method = $_SERVER['REQUEST_METHOD'];
        $redisController = new RedisController();

        if($request_uri === "/api/redis" && $method === "GET") {

            return $redisController->getAll();
        }
        elseif($request_uri === "/api/redis/$key" && $method === "DELETE") {
            return $redisController->remove($key);
        }
        else {
            $controller = new \App\Controllers\RedisController();
            $controller->index();
        }
        die();
    }
}