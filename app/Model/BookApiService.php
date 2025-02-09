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

    private function retrieveResults($results): array
    {
        $books = [];

        foreach ($results as $item) {
            $books[] = [
                'id' => $item['id'] ?? null,
                'title' => $item['volumeInfo']['title'] ?? null,
                'authors' => isset($item['volumeInfo']['authors']) ? implode(', ', $item['volumeInfo']['authors']) : null,
                'publisher' => $item['volumeInfo']['publisher'] ?? null,
                'publishedDate' => $item['volumeInfo']['publishedDate'] ?? null,
                'description' => $item['volumeInfo']['description'] ?? null,
                'pageCount' => $item['volumeInfo']['pageCount'] ?? null,
                'categories' => isset($item['volumeInfo']['categories']) ? implode(', ', $item['volumeInfo']['categories']) : null,
                'averageRating' => $item['volumeInfo']['averageRating'] ?? null,
                'ratingsCount' => $item['volumeInfo']['ratingsCount'] ?? null,
                'cover' => $item['volumeInfo']['imageLinks']['thumbnail'] ?? null,
            ];
        }

        return $books;
    }

    private function getUniqueAuthors(array $books): array
    {
        $authors = [];

        foreach ($books as $book) {
            if (!empty($book['authors'])) {
                $bookAuthors = explode(', ', $book['authors']);
                $authors = array_merge($authors, $bookAuthors);
            }
        }

        return array_unique($authors);
    }

    public function getBookById(string $id): array
    {
        try {
            $item = $this->service->volumes->get($id);
            $book = [
                'title' => $item['volumeInfo']['title'] ?? null,
                'authors' => isset($item['volumeInfo']['authors']) ? implode(', ', $item['volumeInfo']['authors']) : null,
                'publisher' => $item['volumeInfo']['publisher'] ?? null,
                'publishedDate' => $item['volumeInfo']['publishedDate'] ?? null,
                'description' => $item['volumeInfo']['description'] ?? null,
                'pageCount' => $item['volumeInfo']['pageCount'] ?? null,
                'categories' => isset($item['volumeInfo']['categories']) ? $item['volumeInfo']['categories'] : null,
                'averageRating' => $item['volumeInfo']['averageRating'] ?? null,
                'ratingsCount' => $item['volumeInfo']['ratingsCount'] ?? null,
                'cover' => $item['volumeInfo']['imageLinks']['thumbnail'] ?? null,
                'language' => $item['volumeInfo']['language'] ?? null,
                'isbn' => $item['volumeInfo']['industryIdentifiers'][1]["identifier"] ?? null,
                'buyLink' => $item['saleInfo']['buyLink'] ?? null
            ];

            bdump($book);
            return $book;
        } catch (\Exception $e) {
            return ['Error' => $e->getMessage()];
        }
    }

    public function searchBooksByCriteria(string $query, string $type, int $page = 1): array
    {
        $startIndex = ($page - 1) * self::MAX_RESULTS;
        $formerQuery = $query;

        $params = [
            'orderBy' => 'relevance',
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
            $books = $this->retrieveResults($results);
            $uniqueAuthors = $this->getUniqueAuthors($books);
            $totalPages = ceil($results['totalItems'] / self::MAX_RESULTS);
            return [
                'query' => $formerQuery,
                'filter' => $type,
                'page' => $page,
                'totalItems' => $results['totalItems'] ?? 0,
                'totalPages' => $totalPages,
                'books' => $books,
                'filterAuthors' => $uniqueAuthors
            ];
        }
        catch(\Exception $e){
            return ['Error' => $e->getMessage()];
        }
    }




}