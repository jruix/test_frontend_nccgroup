<?php

namespace JonathanRuiz\Solution\Dao;

use PDO;

/**
 * Helper to query a Database instance
 * in the repositories
 */
abstract class AbstractDatabaseImplementation {
    /**
     * @var PDO
     */
    protected $client;

    public function __construct(PDO $client) {
        $this->client = $client;
    }
}
