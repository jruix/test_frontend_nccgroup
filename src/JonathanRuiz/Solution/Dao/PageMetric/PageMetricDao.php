<?php

namespace JonathanRuiz\Solution\Dao\PageMetric;

use JonathanRuiz\Solution\Dao\PageMetric\Exception\MissingRecordException;
use JonathanRuiz\Solution\Model\PageMetric;

interface PageMetricDao {

    /**
     * Gets all page metrics
     * @return PageMetric[]
     */
    public function getAll();

    /**
     * Gets one element by it's id property
     * @param int $id
     * @return PageMetric
     * @throws MissingRecordException
     */
    public function getById($id);

    /**
     * Saves a PageMetric instance
     * @param PageMetric $pageMetric
     */
    public function save(PageMetric $pageMetric);
}
