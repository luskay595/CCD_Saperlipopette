<?php

namespace api_clients\application\actions;

use api_besoins\application\actions\AbstractAction;
use Error;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use renderer\JsonRenderer;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use api_clients\core\dto\ClientDTO;
use api_clients\application\actions\ServiceClients;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;

class CreateClientAction extends AbstractAction
{
    private ServiceClients $serviceClients;
    private $logger;

    public function __construct(ServiceClients $serviceClients, $logger)
    {
        $this->serviceClients = $serviceClients;
        $this->logger = $logger;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // Parse JSON body
        $jsonClient = $rq->getParsedBody();

        // Validate input
        $clientInputValidator = v::key('id', v::intVal()->notEmpty())
            ->key('nom', v::stringType()->notEmpty());

        try {
            $clientInputValidator->assert($jsonClient);

            // Create ClientDTO object
            $client = new ClientDTO(
                $jsonClient['id'],
                $jsonClient['nom'],
                $jsonClient['email']
            );

            // Call service to create client
            $this->serviceClients->createClient(
                $client->getId(),
                $client->getNom(),
            );

            // Log creation
            $this->logger->info('CreateClient : '.$client->getId());

            return $rs;

        } catch (NestedValidationException $e) {
            $this->logger->error('CreateClient : '.$e->getMessage());
            throw new HttpBadRequestException($rq, $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error('CreateClient : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (Error $e) {
            $this->logger->error('CreateClient : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}