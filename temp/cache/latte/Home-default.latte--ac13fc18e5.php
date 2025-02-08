<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/mp/app/UI/Home/default.latte */
final class Template_ac13fc18e5 extends Latte\Runtime\Template
{
	public const Source = '/var/www/mp/app/UI/Home/default.latte';

	public const Blocks = [
		['styles' => 'blockStyles', 'content' => 'blockContent', 'scripts' => 'blockScripts'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('styles', get_defined_vars()) /* line 1 */;
		echo "\n";
		$this->renderBlock('content', get_defined_vars()) /* line 17 */;
		echo "\n";
		$this->renderBlock('scripts', get_defined_vars()) /* line 233 */;
	}


	/** {block styles} on line 1 */
	public function blockStyles(array $ʟ_args): void
	{
		echo '<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/swiper-icons.css">
<link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/fonts/material-icons.min.css">
<link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
<link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
<link rel="stylesheet" href="assets/css/Navbar-With-Button-icons.css">
<link rel="stylesheet" href="assets/css/slider.css">
<link rel="stylesheet" href="assets/css/styles-book-detail.css">
<link rel="stylesheet" href="assets/css/styles-categories.css">
<link rel="stylesheet" href="assets/css/styles-results.css">
<link rel="stylesheet" href="assets/css/styles.css">
';
	}


	/** {block content} on line 17 */
	public function blockContent(array $ʟ_args): void
	{
		echo '<section class="py-4 py-xl-5" style="/*padding-top: 59px;*/height: 420px;margin-top: 50px;">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-auto col-lg-8 text-center justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                <div>
                    <h2 class="text-uppercase fw-bold mb-3" style="font-size: 50px;margin-top: 16px;">Objev svět knih!</h2>
                    <p class="mb-4" style="font-size: 18px;"><br>Zadej název knihy nebo jméno autora a najdi svou další četbu.<br><br></p>
                </div>
                <div>
                    <form style="display: flex;"><input class="form-control" type="search" name="book_search" placeholder="Hledat" style="height: 60px;border-bottom-right-radius: 0px;border-top-right-radius: 0px;border-top-left-radius: 8px;border-bottom-left-radius: 8px;width: 100%;border-style: solid;border-right-style: none;"><select class="form-select" style="border-radius: 0;width: auto;text-align: left;border-right-style: none;border-left-style: none;">
                            <option value="all" selected="">Všechno</option>
                            <option value="title">Podle názvu</option>
                            <option value="author">Podle autora</option>
                            <option value="isbn">Podle ISBN</option>
                        </select><button class="btn btn-primary" type="button" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;width: 105.5938px;font-weight: bold;border-top-right-radius: 8px;border-bottom-right-radius: 8px;">Hledat</button></form>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-4 py-xl-5">
        <div class="row gy-4 row-cols-2 row-cols-md-4">
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" style="background: radial-gradient(#110077, #16009d);"><i class="fas fa-book"></i></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0 stat1">40M+</h2>
                        <p class="mb-0">knih</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" style="background: radial-gradient(#110077, #16009d);"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0 stat2">10M+</h2>
                        <p class="mb-0">autorů</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" style="background: radial-gradient(#110077, #16009d);"><i class="fa fa-language"></i></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0 stat3">100+</h2>
                        <p class="mb-0">jazyků</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" style="background: radial-gradient(#110077, #16009d);"><i class="material-icons" style="font-size: 42px;">movie</i></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0 stat4">50+</h2>
                        <p class="mb-0">žánrů</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="books-selection-container">
    <div></div>
    <div class="index-slider-container">
        <h1 style="padding-left: 40px;margin-bottom: 36px;">Nejoblíbenější knihy</h1><div class="slider-container">
            <button class="slider-button prev"><svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                </svg>
            </button>
            <div class="slider-wrapper">
                <div class="slider">

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img
                                        src="http://books.google.com/books/content?id=NKnPsgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api" />
                            </div>
                            <div class="book-title">Na západní frontě klid</div>
                            <div class="book-author">Erich Maria Remarque</div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title2</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title3</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title4</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title5</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title6</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title7</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title8</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title9</h1>
                            </div>
                        </a>
                    </div>

                    <div class="book-card">

                        <a class="book_link" href="#">
                            <div class="book-cover">
                                <img src="assets/img/book_cover_placeholder.jpg" />
                            </div>
                            <div class="book-title">
                                <h1>Title10</h1>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <button class="slider-button next"><svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                </svg>


            </button>
        </div>
    </div>
</section>
';
	}


	/** {block scripts} on line 233 */
	public function blockScripts(array $ʟ_args): void
	{
		echo '<script src="assets/js/slider.js"></script>
<script src="assets/js/statCountUp.js"></script>
';
	}
}
