<?php

namespace App\Model;

class FileManager
{
    public function __construct(
        private string $wwwDir
    )
    {
    }

    public function get10RecommendedTitles(): array
    {
        $filePath = $this->wwwDir . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'recommended-books.json';
        bdump($filePath);

        $jsonData = file_get_contents($filePath);


        $books = json_decode($jsonData, true);

        if ($books === null) {
            throw new \Exception('Chyba při čtení JSON souboru.');
        }

        shuffle($books);
        $selectedBooks = array_slice($books, 0, 10);

        $topBooksTitles = array_map(function ($book) {
            return [
                "id" => $book['id'],
                "title" => $book['title'],
                "authors" => $book['author'],
                "cover" => $book['thumbnail'],
                "publishedDate" => $book['publishedDate']
            ];
        }, $selectedBooks);

        return $topBooksTitles;
    }

}