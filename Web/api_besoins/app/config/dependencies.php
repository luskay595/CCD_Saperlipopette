<?php


use Psr\Container\ContainerInterface;

return [

    'pdo' => function(ContainerInterface $c) {
        $pdo = new PDO('pgsql:host=db_geoquizz;dbname=geoquizz', 'geoquizz', 'geoquizz');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    },

    'client.directus' => function(ContainerInterface $c){
        return new GuzzleHttp\Client([
            'base_uri' => 'http://directus:8055',
            'timeout' => 2.0,
        ]);
    },


];