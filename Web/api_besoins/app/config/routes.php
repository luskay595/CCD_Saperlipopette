<?php
declare(strict_types=1);


use api_besoins\application\actions\HomeAction;
use api_besoins\application\actions\GetBesoinByIdAction;

return function(\Slim\App $app): \Slim\App {

    // Routes
    $app->get('/', HomeAction::class)->setName('home');

    $app->get('/besoins/{id}', GetBesoinByIdAction::class)->setName('getBesoinById');

    return $app;
};
