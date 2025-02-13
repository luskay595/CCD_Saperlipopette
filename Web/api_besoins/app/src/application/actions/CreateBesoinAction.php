<?php

namespace api_besoins\application\actions;

use Error;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use api_besoins\application\renderer\JsonRenderer;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use api_beosins\core\dto\BesoinsDTO;
use api_besoins\application\actions\ServiceBesoins;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;


class CreateBesoinAction extends AbstractAction
{
    private $serviceBesoins;
    private $loger;

    public function __construct(ServiceBesoins $serviceBesoins, $loger)
    {
        $this->serviceBesoins = $serviceBesoins;
        $this->loger = $loger;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // Parse JSON body
        $jsonRdv = $rq->getParsedBody();

        // Validate input
        $rdvInputValidator = v::key('client_name', v::stringType()->notEmpty())
            ->key('besoin', v::stringType()->notEmpty())
            ->key('competence', v::stringType()->notEmpty());

        try {
            $rdvInputValidator->assert($jsonRdv);

            // Create BesoinsDTO object
            $besoin = new BesoinsDTO(
                $jsonRdv['id'],
                $jsonRdv['besoin'],
                $jsonRdv['client_name'],
                $jsonRdv['competence'],
                []
            );

            // Call service to create besoin
            $this->serviceBesoins->createBesoin(
                $besoin->getId(),
                $besoin->getLibelle(),
                $besoin->getClientNom(),
                $besoin->getCompetenceType(),
                $besoin->getServices()
            );


            // Log creation
            $this->loger->info('CreateBesoin : '.$besoin->getId());

            return $rs;

        } catch (NestedValidationException $e) {
            $this->loger->error('CreateBesoin : '.$e->getMessage());
            throw new HttpBadRequestException($rq, $e->getMessage());
        } catch (\Exception $e) {
            $this->loger->error('CreateBesoin : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (Error $e) {
            $this->loger->error('CreateBesoin : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}
