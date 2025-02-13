<?php
namespace api_clients\application\actions;

use api_clients\application\renderer\JsonRenderer;
use api_clients\core\services\clients\ServiceClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetAllClientsAction extends AbstractAction
{

    private ServiceClientInterface $serviceClient;

    public function __construct(ServiceClientInterface $serviceClientInterface)
    {
        $this->serviceClient = $serviceClientInterface;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        try{
        $clients = $this->serviceClient->getAllClients();
        $data = [
            'type' => 'ressource',
            'clients' => $clients
        ];
        return JSONRenderer::render($rs, 200, $data);
        }catch(\Exception $e){
            return JSONRenderer::render($rs, 404, ['error' => $e->getMessage()]);
        }
    }
}
