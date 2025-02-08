<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\Model\FileManager;
use Nette;
use App\Model\BookApiService;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
    private FileManager $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function renderDefault()
    {
        try {
            $this->template->recommendedBooks = $this->fileManager->get10RecommendedTitles();
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

    }
}
