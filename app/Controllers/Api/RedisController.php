<?php

namespace App\Controllers\Api;

use App\Models\RedisModel;
use Minicli\RedisClient;
use Predis\Client;

class RedisController
{
    protected $client = null;

    public function __construct()
    {
        $this->client = new RedisClient();
    }

    public function getAll()
    {
        $model = new RedisModel();

         $data = json_encode([
            'status' => true,
            'code' => 200,
            'data' => $model->getAll(),
        ]);

         printf($data);
    }

    public function remove($key)
    {
        $model = new RedisModel();

        if ($model->remove($key)) {
            $data = json_encode([
                'status' => true,
                'code' => 200,
                'data' => [],
            ]);
            printf($data);
        }

        $data = json_encode([
            'status' => false,
            'code' => 500,
            'data' => ['message' => 'Error info message’'],
        ]);

        printf($data);
    }
}