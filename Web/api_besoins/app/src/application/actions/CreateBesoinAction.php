<?php

namespace api_besoins\application\actions;

use Error;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use api_besoins\application\renderer\JsonRenderer;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use api_besoins\core\services\besoins\ServiceBesoins;
use api_besoins\core\dto\InputBesoinsDTO;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Psr\Log\LoggerInterface;

class CreateBesoinAction extends AbstractAction
{
    private $serviceBesoins;
    private $logger;

    public function __construct(ServiceBesoins $serviceBesoins, LoggerInterface $logger)
    {
        $this->serviceBesoins = $serviceBesoins;
        $this->logger = $logger;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // Parse JSON body
        $jsonRdv = $rq->getParsedBody();

        // Validate input
        $rdvInputValidator = v::key('client_nom', v::stringType()->notEmpty())
            ->key('libelle', v::stringType()->notEmpty())
            ->key('competence_type', v::stringType()->notEmpty());

        try {
            $rdvInputValidator->assert($jsonRdv);

            // Create BesoinsDTO object
            echo "avant besoinDTO";
            $besoin = new InputBesoinsDTO(
                $jsonRdv['libelle'],
                $jsonRdv['client_nom'],
                $jsonRdv['competence_type'],
                []
            );
            echo "apres besoinDTO";

            // Call service to create besoin
            $this->serviceBesoins->createBesoin(
                $besoin->getLibelle(),
                $besoin->getClientNom(),
                $besoin->getCompetenceType(),
                $besoin->getServices()
            );

            // Log creation
            $this->logger->info('CreateBesoin : '.$besoin->getLibelle().' created');

            return $rs;

        } catch (NestedValidationException $e) {
            $this->logger->error('CreateBesoin : '.$e->getMessage());
            throw new HttpBadRequestException($rq, $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error('CreateBesoin : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (Error $e) {
            $this->logger->error('CreateBesoin : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}
