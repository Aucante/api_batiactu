<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use const Grpc\STATUS_UNAUTHENTICATED;

class CallApiService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getContacts(): array
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:3000/api/contact'
        );

        return $response->toArray();
    }

    public function getItem($id): array
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:3000/api/contact/' . $id
        );

        return $response->toArray();
    }


    public function getLogin($username, $password)
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:3000/api/login',
            ['json' => [
                'username' => $username,
                'password' => $password,
            ]]
        );

        if ($response->getStatusCode() === Response::HTTP_UNAUTHORIZED) {
           return Response::HTTP_UNAUTHORIZED;
        }

        return $response->toArray();
    }
}



