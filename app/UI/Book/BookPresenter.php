<?php

namespace App\UI\Book;

use App\Model\BookApiService;
use Nette\Application\UI\Presenter;

class BookPresenter extends Presenter
{
    public function __construct(
        private readonly BookApiService $bookService
    )
    {
    }

    public function actionDetails($id): void
    {
        try{
            $book = $this->bookService->getBookById($id);
            $similarBooks = $this->bookService->searchSimilarBooks($book['title']);
        }catch (\Exception $e){
            $this->error("Kniha nebyla nalezena.", 404);
        }

        $this->template->similarBooks = $similarBooks;
        $this->template->book = $book;
    }
}