<?php

namespace api_besoins\application\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

 class HomeAction extends AbstractAction
 {


    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {
        $rs->getBody()->write('Welcome to BESOINS API');
        return $rs;}

}