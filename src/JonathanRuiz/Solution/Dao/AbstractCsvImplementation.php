<?php

namespace JonathanRuiz\Solution\Dao;

use League\Csv\Reader;
use League\Csv\Writer;

/**
 * Helper to query a CSV file
 * in the repositories
 */
abstract class AbstractCsvImplementation {
    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var Writer
     */
    protected $writer;

    public function __construct(Reader $reader, Writer $writer) {
        $this->reader = $reader;
        $this->writer = $writer;
    }
}
