<?php

namespace App\Model;
use Google\Client;
use Google\Service\Books;

class BookApiService
{
    private Client $client;
    private Books $service;

    public function __construct(
        private readonly string $API_KEY,
        private string $wwwDir
    )
    {
        $this->client = new Client();
        $this->client->setApplicationName("MP");
        $this->client->setDeveloperKey($this->API_KEY);

        $this->service = new Books($this->client);
    }

    private function retrieveDetails($results): array
    {
        $books = [];

        foreach ($results as $item) {
            $books[] = [
                'title' => $item['volumeInfo']['title'] ?? 'Unknown',
                'authors' => isset($item['volumeInfo']['authors']) ? implode(', ', $item['volumeInfo']['authors']) : 'Unknown',
                'publisher' => $item['volumeInfo']['publisher'] ?? 'Unknown',
                'publishedDate' => $item['volumeInfo']['publishedDate'] ?? 'Unknown',
                'description' => $item['volumeInfo']['description'] ?? 'Unknown',
                'pageCount' => $item['volumeInfo']['pageCount'] ?? 'Unknown',
                'categories' => isset($item['volumeInfo']['categories']) ? implode(', ', $item['volumeInfo']['categories']) : 'Unknown',
                'averageRating' => $item['volumeInfo']['averageRating'] ?? 'Unknown',
                'ratingsCount' => $item['volumeInfo']['ratingsCount'] ?? 'Unknown',
                'cover' => $item['volumeInfo']['imageLinks']['thumbnail'] ?? 'Unknown',
            ];
        }

        return $books;
    }

    public function getBooksByQuery(string $query): array
    {
        $params = [
            'maxResults' => 40,
            'orderBy' => 'relevance',
        ];

        try{
            $results = $this->service->volumes->listVolumes($query, $params);
            return $this->retrieveDetails($results);
        }
        catch(\Exception $e){
            return ['Error' => $e->getMessage()];
        }
    }

    public function getBookById(string $id): array
    {
        try {
            $item = $this->service->volumes->get($id);
            return $this->retrieveDetails($item);
        } catch (\Exception $e) {
            return ['Error' => $e->getMessage()];
        }
    }


}