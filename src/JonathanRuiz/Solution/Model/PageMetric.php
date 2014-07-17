<?php

namespace JonathanRuiz\Solution\Model;

use DateTime;

/**
 * Class to handle page metrics
 */
class PageMetric {
    const KEY = 'PageMetric';

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var DateTime $date
     */
    private $date;

    /**
     * @var float $responseTime
     */
    private $responseTime;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setDate(DateTime $date) {
        $this->date = $date;

        return $this;
    }

    /**
     * @return float
     */
    public function getResponseTime() {
        return $this->responseTime;
    }

    /**
     * @param float $responseTime
     * @return $this
     */
    public function setResponseTime($responseTime) {
        $this->responseTime = $responseTime;

        return $this;
    }
}
