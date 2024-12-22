<?php

declare(strict_types=1);

namespace App\UI\Home;

use Nette;
use App\Model\BookApiService;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
    private BookApiService $bookApiService;

    public function __construct(BookApiService $bookApiService)
    {
        $this->bookApiService = $bookApiService;
    }

    /**public function renderDefault()
    {
        $query = "Na západní frontě klid";
        $books = $this->bookApiService->getBooksByQuery($query);
        $this->template->books = $books;
    }
    **/
}
