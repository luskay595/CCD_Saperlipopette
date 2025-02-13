<?php

namespace api_competences\application\actions;


use api_competences\core\domain\entities\AbstractAction;
use Error;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use api_competences\core\domain\entities\Competence;
use api_competences\core\services\competences\ServiceCompetences;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;

class GetCompetenceByIdAction extends AbstractAction
{
    private ServiceCompetences $serviceCompetences;
    private $logger;

    public function __construct(ServiceCompetences $serviceCompetences, $logger)
    {
        $this->serviceCompetences = $serviceCompetences;
        $this->logger = $logger;
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // Parse JSON body
        $jsonCompetence = $rq->getParsedBody();

        // Validate input
        $competenceInputValidator = v::key('libelle', v::stringType()->notEmpty())
            ->key('description', v::stringType()->notEmpty())
            ->key('type', v::stringType()->notEmpty());

        try {
            $competenceInputValidator->assert($jsonCompetence);

            // Create Competence object
            $competence = new Competence(
                0,
                $jsonCompetence['libelle'],
                $jsonCompetence['description'],
                $jsonCompetence['type']
            );

            // Call service to create competence
            $this->serviceCompetences->createCompetence(
                $competence->getLibelle(),
                $competence->getDescription(),
                $competence->getType()
            );

            // Log creation
            $this->logger->info('CreateCompetence : '.$competence->getLibelle());

            return $rs->withStatus(201);

        } catch (NestedValidationException $e) {
            $this->logger->error('CreateCompetence : '.$e->getMessage());
            throw new HttpBadRequestException($rq, $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error('CreateCompetence : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (Error $e) {
            $this->logger->error('CreateCompetence : '.$e->getMessage());
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}