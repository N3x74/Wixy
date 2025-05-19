<?php

namespace N3x74\Wixy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Api
{
    private string $baseUrl = "https://open.nestcode.org/";
    private string $apiKey;
    private int $apiVersion;
    private Client $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 10.0,
        ]);
    }

    public function version(int $version): static
    {
        $this->apiVersion = $version;
        return $this;
    }

    public function get(string $endpoint, array $params = []): array
    {
        $params['key'] = $this->apiKey;
        $url = $this->buildUrl($endpoint, $params);

        try {
            $response = $this->client->request('GET', $url);
            return [
                'status_code' => $response->getStatusCode(),
                'body' => json_decode((string)$response->getBody(), true),
            ];
        } catch (RequestException $e) {
            $rawBody = (string)($e->getResponse()?->getBody() ?? '');
            $decoded = json_decode($rawBody, true);

            return [
                'status_code' => $e->getResponse()?->getStatusCode() ?? 0,
                'body' => json_last_error() === JSON_ERROR_NONE ? $decoded : $rawBody,
                'error' => $e->getMessage(),
            ];
        }
    }

    private function buildUrl(string $endpoint, array $params): string
    {
        $query = http_build_query($params);
        $apiPath = "apis-{$this->apiVersion}/{$endpoint}";
        return $query ? "{$apiPath}?{$query}" : $apiPath;
    }
}
