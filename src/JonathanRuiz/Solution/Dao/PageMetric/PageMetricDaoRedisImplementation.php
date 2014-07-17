<?php

namespace JonathanRuiz\Solution\Dao\PageMetric;

use JonathanRuiz\Solution\Dao\AbstractRedisImplementation;
use JonathanRuiz\Solution\Dao\PageMetric\Exception\MissingRecordException;
use JonathanRuiz\Solution\Model\PageMetric;

/**
 * Redis implementation for the PageMetric model
 */
class PageMetricDaoRedisImplementation extends AbstractRedisImplementation implements PageMetricDao {
    /**
     * Gets all page metrics
     * @return PageMetric[]
     */
    public function getAll() {
        $elements = $this->client->get(PageMetric::KEY);

        $result = [];
        foreach ($elements as $element) {
            $result[] = unserialize($element);
        }

        return $result;
    }


    /**
     * Gets one element by it's id property
     * @param int $id
     * @return PageMetric
     * @throws MissingRecordException
     */
    public function getById($id) {
        if (!$this->client->has(PageMetric::KEY . $id)) {
            throw new MissingRecordException('Element with id ' . $id . ' does not exist');
        }

        return unserialize($this->client->get(PageMetric::KEY . $id));
    }


    /**
     * Saves a PageMetric instance
     * @param PageMetric $pageMetric
     */
    public function save(PageMetric $pageMetric) {
        $serializedObject = serialize($pageMetric);

        $this->client->set(PageMetric::KEY . $pageMetric->getId(), $serializedObject);
        $this->client->rpush(PageMetric::KEY, $serializedObject);
    }
}
