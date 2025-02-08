<?php

namespace App\Model;
use Google\Client;
use Google\Service\Books;

class BookApiService
{
    private Client $client;
    private Books $service;
    private const MAX_RESULTS = 30;

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

    public function searchBooksByQuery(string $query, int $page = 1): array
    {
        $startIndex = ($page - 1) * self::MAX_RESULTS;

        $params = [
            'orderBy' => 'relevance',
            'maxResults' => self::MAX_RESULTS,
            'startIndex' => $startIndex,
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

            bdump($book);
            return $book;
        } catch (\Exception $e) {
            return ['Error' => $e->getMessage()];
        }
    }

    private function searchBooksByCriteria(string $query, string $type, int $page = 1): array
    {
        $startIndex = ($page - 1) * self::MAX_RESULTS;

        $params = [
            'maxResults' => self::MAX_RESULTS,
            'startIndex' => $startIndex,
        ];

        switch ($type){
            case "author":
                $query = 'inauthor:' . $query;
                break;
            case "title":
                $query = 'intitle:' . $query;
                break;
            case "isbn":
                $query = 'isbn:' . $query;
                break;
            case "category":
                $query = 'subject:' . $query;
                break;
            default:
                break;
        }

        try{
            $results = $this->service->volumes->listVolumes($query, $params);
            return $this->retrieveDetails($results);
        }
        catch(\Exception $e){
            return ['Error' => $e->getMessage()];
        }
    }




}