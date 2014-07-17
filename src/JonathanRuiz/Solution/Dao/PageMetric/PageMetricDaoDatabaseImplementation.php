<?php

namespace JonathanRuiz\Solution\Dao\PageMetric;

use DateTime;
use JonathanRuiz\Solution\Dao\AbstractDatabaseImplementation;
use JonathanRuiz\Solution\Dao\PageMetric\Exception\MissingRecordException;
use JonathanRuiz\Solution\Model\PageMetric;
use PDO;

/**
 * Database implementation for the PageMetric model
 */
class PageMetricDaoDatabaseImplementation extends AbstractDatabaseImplementation implements PageMetricDao {
    /**
     * Gets all page metrics
     * @return PageMetric[]
     */
    public function getAll() {
        $stmt = $this->client->query('SELECT * FROM page_metrics');
        $elements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($elements as $element) {
            $result[] = $this->hydrateObject($element);
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
        $stmt = $this->client->prepare('SELECT * FROM page_metrics WHERE id=?');
        $stmt->execute([$id]);

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            throw new MissingRecordException('Element with id ' . $id . ' does not exist');
        }

        return $this->hydrateObject($record);
    }


    /**
     * Saves a PageMetric instance
     * @param PageMetric $pageMetric
     */
    public function save(PageMetric $pageMetric) {
        $stmt = $this->client->prepare('INSERT INTO page_metrics(url,tracked_date,response_time) VALUES(:url,:tracked_date,:response_time)');
        $stmt->execute([
            ':url' => $pageMetric->getUrl(),
            ':tracked_date' => $pageMetric->getDate()->format('Y-m-d H:i:s'),
            ':response_time' => $pageMetric->getResponseTime()
        ]);
    }

    /**
     * @param array $element
     * @return PageMetric
     */
    private function hydrateObject(array $element) {
        $pageMetric = new PageMetric();
        $pageMetric->setId($element['id']);
        $pageMetric->setDate(DateTime::createFromFormat('Y-m-d H:i:s', $element['tracked_date']));
        $pageMetric->setUrl($element['url']);
        $pageMetric->setResponseTime($element['response_time']);

        return $pageMetric;
    }
}
