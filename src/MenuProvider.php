<?php

namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class MenuProvider
{
    private const PATH = '/daily-menu';
    private HttpClientInterface $client;
    private LoggerInterface $logger;
    private string|array|false $baseUrl;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger, $baseUrl)
    {
        $this->client = $client;
        $this->logger = $logger;
        $this->baseUrl = $baseUrl;
    }

    public function getMenu(int $restaurantId): array
    {
        $response = [];
        try {
            $response = $this->client->request('GET', $this->baseUrl.self::PATH, ['query' => [$restaurantId]]);
            if ($response->getStatusCode() === 200 && !empty($response->getContent())) {
                return $response->toArray(false);
            }
            $response = [];
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        return $response;
    }

}
