<?php

use api_besoins\core\domain\entities\Besoins\Besoin;
use Psr\Container\ContainerInterface;

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

    

];