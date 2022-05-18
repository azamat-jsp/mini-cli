<?php

namespace App\Controllers;

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

    private function getClient(): Client
    {
        return $this->client->getClient();
    }

    public function index()
    {
        $model = new RedisModel();
        $data = $model->getAll();

        echo $this->render('app/Views/index.php',
            ['data' => json_decode($data)]
        );
        die();
    }

    public function remove($key)
    {
        $model = new RedisModel();

        if ($model->remove($key)) {
            return json_encode([
                'status' => true,
                'code' => 200,
                'data' => [],
            ]);
        }

        return json_encode([
            'status' => false,
            'code' => 500,
            'data' => ['message' => 'Error info message’'],
        ]);
    }

    private function render($filename, $vars = null) {
        if (is_array($vars) && !empty($vars)) {
            extract($vars);
        }
        ob_start();
        include $filename;
        return ob_get_clean();
    }
}