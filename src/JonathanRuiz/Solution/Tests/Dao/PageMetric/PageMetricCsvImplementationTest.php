<?php

namespace JonathanRuiz\Solution\Tests\Dao\PageMetric;

use DateTime;
use JonathanRuiz\Solution\Dao\PageMetric\PageMetricDao;
use JonathanRuiz\Solution\Dao\PageMetric\PageMetricDaoCsvImplementation;
use JonathanRuiz\Solution\Model\PageMetric;
use League\Csv\Reader;
use League\Csv\Writer;

class PageMetricCsvImplementationTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var PageMetricDao
     */
    private $implementation;

    public function setUp() {
        $file = __DIR__ . '/file.csv';
        $handle = fopen($file, 'w');
        fclose($handle);

        $this->implementation = new PageMetricDaoCsvImplementation(
            new Reader($file),
            new Writer($file)
        );
    }

    public function testSavingOneElement() {
        $pageMetric = new PageMetric();
        $pageMetric->setId(1);
        $pageMetric->setUrl('http://www.google.es');
        $pageMetric->setDate(new DateTime());
        $pageMetric->setResponseTime(5.33);

        $this->implementation->save($pageMetric);

        $this->assertEquals(1, count($this->implementation->getAll()));
    }

    public function testSavingMultipleElements() {
        $pageMetric = new PageMetric();
        $pageMetric->setId(1);
        $pageMetric->setUrl('http://www.google.es');
        $pageMetric->setDate(new DateTime());
        $pageMetric->setResponseTime(5.33);

        $this->implementation->save($pageMetric);

        $pageMetric = new PageMetric();
        $pageMetric->setId(1);
        $pageMetric->setUrl('http://www.google.es');
        $pageMetric->setDate(new DateTime());
        $pageMetric->setResponseTime(5.33);

        $this->implementation->save($pageMetric);

        $this->assertEquals(2, count($this->implementation->getAll()));
    }

    public function testGetOneById() {
        $pageMetric1 = new PageMetric();
        $pageMetric1->setId(1);
        $pageMetric1->setUrl('http://www.google.es');
        $pageMetric1->setDate(new DateTime());
        $pageMetric1->setResponseTime(5.33);

        $this->implementation->save($pageMetric1);

        $pageMetric2 = new PageMetric();
        $pageMetric2->setId(2);
        $pageMetric2->setUrl('http://www.google.es');
        $pageMetric2->setDate(new DateTime());
        $pageMetric2->setResponseTime(5.33);

        $this->implementation->save($pageMetric2);

        $this->assertInstanceOf('JonathanRuiz\Solution\Model\PageMetric', $this->implementation->getById(1));
        $this->assertEquals($pageMetric1, $this->implementation->getById(1));
    }

    public function testGetOneById_throwsExceptionForNonExistentElement() {
        $pageMetric = new PageMetric();
        $pageMetric->setId(1);
        $pageMetric->setUrl('http://www.google.es');
        $pageMetric->setDate(new DateTime());
        $pageMetric->setResponseTime(5.33);

        $this->implementation->save($pageMetric);

        $pageMetric = new PageMetric();
        $pageMetric->setId(2);
        $pageMetric->setUrl('http://www.google.es');
        $pageMetric->setDate(new DateTime());
        $pageMetric->setResponseTime(5.33);

        $this->implementation->save($pageMetric);

        $this->setExpectedException('JonathanRuiz\Solution\Dao\PageMetric\Exception\MissingRecordException');
        $this->implementation->getById(3);
    }

    public function tearDown() {
        unlink(__DIR__ . '/file.csv');
    }
} 
