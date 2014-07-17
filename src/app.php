<?php

use JonathanRuiz\Solution\Dao\PageMetric\PageMetricDaoCsvImplementation;
use JonathanRuiz\Solution\Form\PageMetricForm;
use League\Csv\Reader;
use League\Csv\Writer;
use Silex\Application;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TranslationServiceProvider;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider(), [
    'translator.domains' => [],
]);

$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    return $twig;
}));

/**
 * We create a shared service, which ensures
 * only one instance is created during a request
 */
$app['page_metric_dao'] = $app->share(function () {
    $file = __DIR__ . '/data/file.csv';

    if (!file_exists($file)) {
        $handle = fopen($file, 'w');
        fclose($handle);
    }

    return new PageMetricDaoCsvImplementation(
        new Reader($file),
        new Writer($file, 'a+')
    );
});

$app['page_metric_form'] = $app->share(function ($app) {
    return new PageMetricForm($app['form.factory']);
});

return $app;
