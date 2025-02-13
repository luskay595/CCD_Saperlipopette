<?php

namespace api_clients\application\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use api_clients\application\actions\AbstractAction;

 class HomeAction extends AbstractAction
 {


    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {
        $rs->getBody()->write('Welcome to BESOINS API');
        return $rs;}

}