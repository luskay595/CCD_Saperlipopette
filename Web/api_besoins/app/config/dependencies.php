<?php

use Psr\Container\ContainerInterface;
use api_besoins\core\services\besoins\ServiceBesoinsInterface;
use api_besoins\core\services\besoins\ServiceBesoins;
use api_besoins\application\actions\GetBesoinByIdAction;
use api_besoins\application\actions\GetAllBesoinsAction;
use api_besoins\application\actions\CreateBesoinAction;

use api_besoins\infrastructure\repository\BesoinRepository;

return [

    'pdo' => function(ContainerInterface $c) {
        $pdo = new PDO('pgsql:host=db_besoins;dbname=serviceDating', 'serviceDating', 'serviceDating');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    },

    'repositoryBesoin' => function(ContainerInterface $c) {
        return new BesoinRepository($c->get('pdo'));
    },

    'logger' => function(ContainerInterface $c) {
        $logger = new Monolog\Logger('api_besoins');
        $file_handler = new Monolog\Handler\StreamHandler('logs/api_besoins.log');
        $logger->pushHandler($file_handler);
        return $logger;
    },

    ServiceBesoinsInterface::class => function(ContainerInterface $c) {
        return new ServiceBesoins($c->get('repositoryBesoin'));
    },

    GetBesoinByIdAction::class => function(ContainerInterface $c) {
        return new api_besoins\application\actions\GetBesoinByIdAction($c->get(ServiceBesoinsInterface::class));
    },

    GetAllBesoinsAction::class => function(ContainerInterface $c) {
        return new api_besoins\application\actions\GetAllBesoinsAction($c->get(ServiceBesoinsInterface::class));
    },

    CreateBesoinAction::class => function(ContainerInterface $c) {
        return new api_besoins\application\actions\CreateBesoinAction($c->get(ServiceBesoinsInterface::class), $c->get('logger'));
    },

];