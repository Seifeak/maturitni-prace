<?php

namespace App\UI\Results;

use App\Model\BookApiService;
use Nette\Application\UI\Presenter;

class ResultsPresenter extends Presenter
{
    public function __construct(
        private readonly BookApiService $bookService
    )
    {
    }

    public function renderDefault(string $query, string $filter, int $page = 1): void
    {
        $this->template->query = $query;
        $this->template->filter = $filter;
        $this->template->page = $page;

        $details = $this->bookService->searchBooksByCriteria($query, $filter, $page);
        dump($details["filterAuthors"]);
        $this->template->query = $details['query'];
        $this->template->books = $details['books'];
        $this->template->totalItems = $details['totalItems'];
        $this->template->filterAuthors = $details['filterAuthors'];
        $this->template->filterLanguages = $details['filterLanguages'];
        $this->template->totalPages = $details['totalPages'];
    }
}