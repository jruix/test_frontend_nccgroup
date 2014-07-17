<?php

use JonathanRuiz\Solution\Model\PageMetric;
use JonathanRuiz\Solution\Dao\PageMetric\PageMetricDao;
use JonathanRuiz\Solution\Dao\PageMetric\PageMetricDaoCsvImplementation;
use JonathanRuiz\Solution\Form\PageMetricForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get('/', function () use ($app) {
    /** @var PageMetricDao $pageMetricDao */
    $pageMetricDao = $app['page_metric_dao'];
    return $app['twig']->render('index.html', [
        'metrics' => $pageMetricDao->getAll()
    ]);
})->bind('homepage');

$app->get('/add', function () use ($app) {
    /** @var PageMetricForm $pageMetricForm */
    $pageMetricForm = $app['page_metric_form'];
    return $app['twig']->render('form.html', ['form' => $pageMetricForm->create()->createView()]);
})->bind('add');

$app->post('/add', function (Request $request) use ($app) {
    /** @var PageMetricDao $pageMetricDao */
    $pageMetricDao = $app['page_metric_dao'];

    /** @var PageMetricForm $pageMetricForm */
    $pageMetricForm = $app['page_metric_form'];

    $form = $pageMetricForm->create();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $metric = new PageMetric();
        $metric->setId(uniqid());
        $metric->setUrl($form->get('url')->getData());
        $metric->setDate(DateTime::createFromFormat('Y-m-d', $form->get('date')->getData()));
        $metric->setResponseTime($form->get('responseTime')->getData());

        $pageMetricDao->save($metric);

        return $app->redirect($app['url_generator']->generate('homepage'));
    }

    return $app['twig']->render('form.html', ['form' => $form->createView()]);
})->bind('add_post');

/**
 * Error handling: show an error page when user
 * is in production mode (show stack trace in dev)
 */
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    return new Response($app['twig']->render('default.html', ['code' => $code]));
});
