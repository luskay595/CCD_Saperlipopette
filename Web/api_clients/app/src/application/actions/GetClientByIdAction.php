<?php
namespace api_clients\application\actions;

use api_clients\application\renderer\JsonRenderer;
use api_clients\core\services\clients\ServiceClients;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use api_clients\application\actions\AbstractAction;

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