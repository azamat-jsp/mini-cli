<?php

namespace Minicli;

use Predis\Client;

class RedisClient
{
    protected $parameters = [];
    protected $options = [];

    public function __construct()
    {
        $this->parameters[] = 'tcp://127.0.0.1:6379?database=15&alias=master';
        $this->parameters[] = 'tcp://127.0.0.1:6380?database=15&alias=slave';
        $this->options = ['replication' => true];
    }

    public function getClient(): Client
    {

        $client = new Client($this->parameters, $this->options);
        $client->ttl(3600);

        return $client;


    }
}