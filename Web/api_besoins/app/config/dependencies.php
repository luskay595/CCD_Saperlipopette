<?php

use Psr\Container\ContainerInterface;

return [

    'pdo' => function(ContainerInterface $c) {
        $pdo = new PDO('pgsql:host=db_besoins;dbname=serviceDating', 'serviceDating', 'serviceDating');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    },

];