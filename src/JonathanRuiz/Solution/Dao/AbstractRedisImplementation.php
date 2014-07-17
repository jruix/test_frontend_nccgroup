<?php

namespace JonathanRuiz\Solution\Dao;

use Predis\Client;

/**
 * Helper to query a Redis instance
 * in the repositories
 */
abstract class AbstractRedisImplementation {
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }
}
