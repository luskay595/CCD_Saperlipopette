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
        try{
        $id = $args['id'];
        $besoin = $this->serviceBesoin->getBesoinById($id);
        $data = [
            'type' => 'ressource',
            'besoin' => $besoin,
        ];
        return JSONRenderer::render($rs, 200, $data);
        }catch(\Exception $e){
            return JSONRenderer::render($rs, 404, ['error' => $e->getMessage()]);
        }
    }
}
