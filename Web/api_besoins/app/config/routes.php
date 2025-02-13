<?php
declare(strict_types=1);

use api_besoins\application\actions\GetAllBesoinsAction;
use api_besoins\application\actions\HomeAction;
use api_besoins\application\actions\GetBesoinByIdAction;
use api_besoins\application\actions\CreateBesoinAction;

return function(\Slim\App $app): \Slim\App {

    // Routes
    $app->get('/', HomeAction::class)->setName('home');

    $app->get('/besoins[/]', GetAllBesoinsAction::class)->setName('getAllBesoins');

    $app->get('/besoins/{id}[/]', GetBesoinByIdAction::class)->setName('getBesoinById');

    $app->post('/besoins[/]', CreateBesoinAction::class)->setName('createBesoin');

    return $app;
};
