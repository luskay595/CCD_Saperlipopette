<?php
namespace api_besoins\application\actions;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class Createbesoin
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (!Validator::key('nom_client', Validator::stringType())->validate($data)) {
            throw new HttpBadRequestException($request, 'nom_client is required');
        }

        if (!Validator::key('libelle', Validator::stringType())->validate($data)) {
            throw new HttpBadRequestException($request, 'libelle is required');
        }

        if (!Validator::key('competence', Validator::stringType())->validate($data)) {
            throw new HttpBadRequestException($request, 'competence is required');
        }

        try {
            $apiResponse = $this->httpClient->request('POST', 'http://api_besoins/Createbesoin.php', [
                'form_params' => [
                    'nom_client' => $data['nom_client'],
                    'libelle' => $data['libelle'],
                    'competence' => $data['competence'],
                ],
            ]);

            if ($apiResponse->getStatusCode() === 200) {
                $response->getBody()->write($apiResponse->getBody()->getContents());
                return $response->withStatus(200);
            }
        } catch (GuzzleException $e) {
            throw new HttpNotFoundException($request, 'Error while creating besoin: ' . $e->getMessage());
        }

        throw new HttpNotFoundException($request, 'Error while creating besoin');
    }
}