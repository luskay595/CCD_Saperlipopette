<?php
declare(strict_types=1);


use api_besoins\application\actions\HomeAction;

return function(\Slim\App $app): \Slim\App {

    // Routes
    $app->get('/', HomeAction::class)->setName('home');

    return $app;
};
