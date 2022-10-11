<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\UserController;

require __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../bootstrap.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/articles', function (Request $request, Response $response, $args) {
    $response->getBody()->write("articles");
    return $response;
});

$app->get('/articles/{genre}', function (Request $request, Response $response, $args) {
    $response->getBody()->write("articles du genre ".$args["genre"]);
    return $response;
});

$app->get('/articles/{annee:[0-9]{4}}/{mois:[0-9]{2}}', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(var_dump($args));
    return $response;
});

$app->get('/somme[/{params:(?:[0-9]+\/)+}]', function (Request $request,Response $response, $args) {
    $response->getBody()->write("test");
    print_r($args);
    return $response;
});

$app->get('/users',\App\UserController::class . ':test');

$app->run();
