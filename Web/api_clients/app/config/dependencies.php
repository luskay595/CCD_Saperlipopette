<?php

use api_clients\application\actions\GetClientByIdAction;
use api_clients\application\actions\CreateClientAction;
use api_clients\core\services\clients\ServiceClientInterface;
use Psr\Container\ContainerInterface;
use api_clients\core\services\clients\ServiceClients;
use api_clients\infrastructure\repository\ClientRepository;
use GuzzleHttp\Promise\Create;

return [

    'pdo' => function(ContainerInterface $c) {
        $pdo = new PDO('pgsql:host=db_clients;dbname=serviceDating', 'serviceDating', 'serviceDating');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    },

    'repositoryClient' => function(ContainerInterface $c) {
        return new ClientRepository($c->get('pdo'));
    },
    
    'logger' => function(ContainerInterface $c) {
        $logger = new Monolog\Logger('api_clients');
        $file_handler = new Monolog\Handler\StreamHandler('logs/api_clients.log');
        $logger->pushHandler($file_handler);
        return $logger;
    },

    ServiceClientInterface::class => function(ContainerInterface $c) {
        return new ServiceClients($c->get('repositoryClient'));
    },

    GetClientByIdAction::class => function(ContainerInterface $c) {
        return new GetClientByIdAction($c->get(ServiceClientInterface::class));
    },

    CreateClientAction::class => function(ContainerInterface $c) {
        return new CreateClientAction($c->get(ServiceClientInterface::class), $c->get('logger'));
    },

];