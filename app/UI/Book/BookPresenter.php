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

    public function actionDetails($id)
    {
        $book = $this->bookService->getBookById($id);
        $this->template->book = $book;
        bdump($book);
    }
}