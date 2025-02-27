<?php

namespace App\Model;

use Google\Client;
use Google\Service\Books;
use Nette\Application\BadRequestException;

class BookApiService
{
    private Client $client;
    private Books $service;
    private const MAX_RESULTS = 30;

    public function __construct(
        private readonly string $API_KEY,
        private string          $wwwDir
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
                'cover' => $item['volumeInfo']['imageLinks']['thumbnail'] ?? "/assets/img/book-cover-placeholder.png",
                'language' => $item['volumeInfo']['language'] ?? null,
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

    private function getUniqueLanguages(array $books): array
    {
        $languages = [];

        foreach ($books as $book) {
            if (!empty($book['language'])) {
                $languages[] = $book['language'];
            }
        }
        return array_unique($languages);
    }

    public function getBookById(string $id): array
    {
        try {
            $item = $this->service->volumes->get($id);

            if (!$item || !isset($item['volumeInfo'])) {
                throw new BadRequestException("Book not found", 404);
            }

            $book = [
                'id' => $item['id'] ?? null,
                'title' => $item['volumeInfo']['title'] ?? null,
                'authors' => isset($item['volumeInfo']['authors']) ? implode(', ', $item['volumeInfo']['authors']) : null,
                'publisher' => $item['volumeInfo']['publisher'] ?? null,
                'publishedDate' => $item['volumeInfo']['publishedDate'] ?? null,
                'description' => $item['volumeInfo']['description'] ?? null,
                'pageCount' => $item['volumeInfo']['pageCount'] ?? null,
                'categories' => isset($item['volumeInfo']['categories']) ? $item['volumeInfo']['categories'] : null,
                'averageRating' => $item['volumeInfo']['averageRating'] ?? null,
                'ratingsCount' => $item['volumeInfo']['ratingsCount'] ?? null,
                'cover' => $item['volumeInfo']['imageLinks']['thumbnail'] ?? "/assets/img/book-cover-placeholder.png",
                'language' => $item['volumeInfo']['language'] ?? null,
                'isbn' => $item['volumeInfo']['industryIdentifiers'][1]["identifier"] ?? null,
                'buyLink' => $item['saleInfo']['buyLink'] ?? null
            ];

            return $book;
        } catch (\Google\Exception $e) { // Pokud API hodí chybu
            throw new BadRequestException("Book not found", 404);
        }
    }

    public function searchBooksByCriteria(string $query, string $type, int $page = 1, ?array $filterParams): array
    {
        $startIndex = ($page - 1) * self::MAX_RESULTS;
        $formerQuery = $query;

        // Zpracování filtrů podle parametrů
        $orderBy = $filterParams['orderBy'] ?? 'relevance';
        $authorFilter = $filterParams['authorFilter'] ?? null;
        $langRestrict = $filterParams['langRestrict'] ?? null;


        $params = [
            'orderBy' => $orderBy,
            'maxResults' => self::MAX_RESULTS,
            'startIndex' => $startIndex,
            'langRestrict' => $langRestrict ?? '',
        ];

        switch ($type) {
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

        // Aplikace filtrů na query
        if ($authorFilter) {
            $query = 'inauthor:' . $authorFilter;
        }

        bdump($query);

        try {
            $results = $this->service->volumes->listVolumes($query, $params);
            $books = $this->retrieveResults($results);
            $uniqueAuthors = $this->getUniqueAuthors($books);
            $uniqueLanguages = $this->getUniqueLanguages($books);
            $totalPages = ceil($results['totalItems'] / self::MAX_RESULTS);
            return [
                'query' => $formerQuery,
                'type' => $type,
                'page' => $page,
                'orderBy' => $orderBy,
                'langRestrict' => $langRestrict ?? null,
                'authorFilter' => $authorFilter ?? null,
                'totalItems' => $results['totalItems'] ?? 0,
                'totalPages' => $totalPages,
                'books' => $books,
                'filterAuthors' => $uniqueAuthors,
                'filterLanguages' => $uniqueLanguages,
            ];
        } catch (\Exception $e) {
            return ['Error' => $e->getMessage()];
        }
    }

    public function searchSimilarBooks(string $query, string $excludeId): array
    {
        $params = [
            'orderBy' => 'relevance',
            'maxResults' => 11,
        ];

        try {
            $results = $this->service->volumes->listVolumes($query, $params);
            $books = $this->retrieveResults($results);

            // Odstranění knihy, která je zobrazena
            foreach ($books as $key => $book) {
                if ($book['id'] === $excludeId) {
                    unset($books[$key]);
                }
            }
        } catch (\Exception $e) {
            return ['Error' => $e->getMessage()];
        }

        return $books;


    }


}