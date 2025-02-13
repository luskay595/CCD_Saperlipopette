<?php
namespace api_competences\application\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

 class HomeAction extends \api_besoins\application\actions\AbstractAction
 {


    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {
        $rs->getBody()->write('Welcome to BESOINS API');
        return $rs;}

}