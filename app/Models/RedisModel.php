<?php

namespace App\Models;

use Minicli\RedisClient;
use Predis\Client;

class RedisModel
{
    protected $client = null;
    protected $data = [];


    public function __construct()
    {
        $this->client = new RedisClient();
    }

    private function getClient(): Client
    {
        return $this->client->getClient();
    }

    public function getAll()
    {
        $keys = $this->getClient()->keys('*');

        foreach ($keys as $key) {
            $value = $this->getClient()->get($key);
            $this->data[$key] = $value;
        }

        return json_encode([
            'status' => true,
            'code' => 200,
            'data' => $this->data,
        ]);
    }

    public function remove($key): bool
    {
        $res = $this->getClient()->del($key);

        if ($res) {
            return true;
        }

        return false;
    }
}