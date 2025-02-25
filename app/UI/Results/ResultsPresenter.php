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

    public function renderDefault(string $query, string $type = "all", int $page = 1, ?string $orderBy = null, ?string $authorFilter = null, ?string $langRestrict = null): void
    {
        $filterParams = [
            'orderBy' => $orderBy,
            'authorFilter' => $authorFilter,
            'langRestrict' => $langRestrict,
        ];

        $details = $this->bookService->searchBooksByCriteria($query, $type, $page, $filterParams);
        $this->template->query = $details['query'];
        $this->template->type = $details['type'];
        $this->template->page = $details['page'];
        $this->template->orderBy = $details['orderBy'];
        $this->template->langRestrict = $details['langRestrict'];
        $this->template->authorFilter = $details['authorFilter'];
        $this->template->books = $details['books'];
        $this->template->totalItems = $details['totalItems'];
        $this->template->totalPages = $details['totalPages'];
        $this->template->filterAuthors = $details['filterAuthors'];
        $this->template->filterLanguages = $details['filterLanguages'];

    }
}