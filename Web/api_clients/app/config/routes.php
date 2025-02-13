<?php
declare(strict_types=1);


use api_clients\application\actions\HomeAction;
use api_clients\application\actions\GetClientByIdAction;
use api_clients\application\actions\CreateClientAction;
use api_clients\application\actions\GetAllClientsAction;

return function(\Slim\App $app): \Slim\App {

    // Routes
    $app->get('/', HomeAction::class)->setName('home');

    $app->get('/clients/{id}[/]', GetClientByIdAction::class)->setName('getClientById');

    $app->get('/clients[/]', GetAllClientsAction::class)->setName('getAllClients');

    $app->post('/clients', CreateClientAction::class)->setName('createClient');

    return $app;
};
