<?php
namespace api_clients\application\actions;

use AbstractAction;
use renderer\JsonRenderer;
use api_clients\application\actions\ServiceClients;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetClientByIdAction extends AbstractAction
{
    private ServiceClients $serviceClients;

    public function __construct(ServiceClients $serviceClients)
    {
        $this->serviceClients = $serviceClients;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['id'];
        $client = $this->serviceClients->getClientById($id);
        $data = [
            'type' => 'ressource',
            'client' => $client,
        ];
        return JsonRenderer::render($rs, 200, $data);
    }
}