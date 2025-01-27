<?php

namespace App\UI\Test;

use App\Model\FileManager;
use Nette\Application\UI\Presenter;
use App\Model\BookApiService;

class TestPresenter extends Presenter
{
    private BookApiService $bookApiService;
    private FileManager $fileManager;
    public function __construct(BookApiService $bookApiService, FileManager $fileManager)
    {
        $this->bookApiService = $bookApiService;
        $this->fileManager = $fileManager;
    }

    public function renderDefault(): void
    {
        // 10 náhodných oblíbených knih
        //$topBooks = $this->fileManager->get10RecommendedTitles();
        //$this->template->favorite = $topBooks;

        // book by id
        /*
        $topBooks = $this->fileManager->get10RecommendedTitles();
        $randBook = $topBooks[0];
        $randBookId = $randBook['id'];
        $book = $this->bookApiService->getBookById($randBookId);
        bdump($book);
        $this->template->book = $book;
        */
        // book by query
        $query = "Na západní frontě klid";
        $books = $this->bookApiService->searchBooksByQuery($query);
        $this->template->books = $books;

    }
}