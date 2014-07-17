<?php

namespace JonathanRuiz\Solution\Dao\PageMetric;

use DateTime;
use JonathanRuiz\Solution\Dao\AbstractCsvImplementation;
use JonathanRuiz\Solution\Dao\PageMetric\Exception\MissingRecordException;
use JonathanRuiz\Solution\Model\PageMetric;

/**
 * CSV implementation for the PageMetric model
 */
class PageMetricDaoCsvImplementation extends AbstractCsvImplementation implements PageMetricDao {
    const COLUMNS_NUMBER = 4;
    const ID_COLUMN = 0;
    const DATE_COLUMN = 1;
    const URL_COLUMN = 2;
    const RESPONSE_TIME_COLUMN = 3;
    
    /**
     * Gets all page metrics
     * @return PageMetric[]
     */
    public function getAll() {
        $rows = $this->reader->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            if (count($row) == self::COLUMNS_NUMBER) {
                $result[] = $this->populateObject($row);
            }
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
        $rows = $this->reader->fetchAll();

        foreach ($rows as $row) {
            if ($row[self::ID_COLUMN] == $id) {
                return $this->populateObject($row);
            }
        }

        throw new MissingRecordException('Element with id ' . $id . ' does not exist');
    }

    /**
     * Saves a PageMetric instance
     * @param PageMetric $pageMetric
     */
    public function save(PageMetric $pageMetric) {
        $this->writer->insertOne([
            $pageMetric->getId(),
            $pageMetric->getDate()->format('Y-m-d H:i:s'),
            $pageMetric->getUrl(),
            $pageMetric->getResponseTime()
        ]);
    }

    /**
     * @param array $row
     * @return PageMetric
     */
    private function populateObject(array $row) {
        $pageMetric = new PageMetric();
        $pageMetric->setId($row[self::ID_COLUMN]);
        $pageMetric->setDate(DateTime::createFromFormat('Y-m-d H:i:s', $row[self::DATE_COLUMN]));
        $pageMetric->setUrl($row[self::URL_COLUMN]);
        $pageMetric->setResponseTime($row[self::RESPONSE_TIME_COLUMN]);

        return $pageMetric;
    }
}
