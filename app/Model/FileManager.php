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
        // Cesta k JSON souboru
        $filePath = $this->wwwDir . '/data/recommended-books.json';
        bdump($filePath);

        // Načtení obsahu souboru
        $jsonData = file_get_contents($filePath);


        // Dekódování JSON do PHP pole
        $books = json_decode($jsonData, true);

        // Kontrola, zda jsou data validní
        if ($books === null) {
            throw new \Exception('Chyba při čtení JSON souboru.');
        }

        $topBooksTitles = [];
        for($i=0;$i<=10; $i++){
            $randN = rand(0, (count($books) - 1));
            $topBooksTitles[] = [
                "id" => $books[$randN]['id'],
                "title" => $books[$randN]['title'],
                "authors" => $books[$randN]['author'],
                "cover" => $books[$randN]['thumbnail'],
                "publishedDate" => $books[$randN]['publishedDate']
            ];
        }
        return $topBooksTitles;
    }

}