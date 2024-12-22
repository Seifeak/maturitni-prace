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

    public function getBooksByQuery(string $query): array
    {
        $params = [
            'maxResults' => 40,
        ];

        try{
            $results = $this->service->volumes->listVolumes($query, $params);
            $books = [];

            foreach ($results as $item) {
                $book = [
                    'title' => $item['volumeInfo']['title'],
                    'authors' => isset($item['volumeInfo']['authors']) ? implode(', ', $item['volumeInfo']['authors']) : 'Unknown',
                    'publisher' => $item['volumeInfo']['publisher'] ?? 'Unknown',
                ];

                $books[] = $book;
            }

            return $books;
        }
        catch(\Exception $e){
            return ['Error' => $e->getMessage()];
        }
    }

    public function getBookById(string $id): array
    {
        try {
            $item = $this->service->volumes->get($id);

            $book = [
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

            return $book;
        } catch (\Exception $e) {
            return ['Error' => $e->getMessage()];
        }
    }


}