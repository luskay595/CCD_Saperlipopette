<?php
namespace api_besoins\application\actions;

use api_besoins\application\renderer\JsonRenderer;
use api_besoins\core\services\besoins\ServiceBesoinsInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetBesoinByIdAction extends AbstractAction
{

    private ServiceBesoinsInterface $serviceBesoin;

    public function __construct(ServiceBesoinsInterface $serviceBesoin)
    {
        $this->serviceBesoin = $serviceBesoin;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['id'];
        $partie = $this->serviceBesoin->getBesoinById($id);
        $data = [
            'type' => 'ressource',
            'partie' => $partie,
        ];
        return JSONRenderer::render($rs, 200, $data);
    }
}
