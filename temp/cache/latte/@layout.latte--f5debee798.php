<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/mp/app/UI/@layout.latte */
final class Template_f5debee798 extends Latte\Runtime\Template
{
	public const Source = '/var/www/mp/app/UI/@layout.latte';

	public const Blocks = [
		['scripts' => 'blockScripts'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>';
		if ($this->hasBlock('title')) /* line 7 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('stripHtml', $ʟ_fi, $s));
			}) /* line 7 */;
			echo ' | ';
		}
		echo 'Databáze knih</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/swiper-icons.css">
    <link rel="stylesheet" href="/assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="/assets/css/Navbar-With-Button-icons.css">
';
		$this->renderBlock('styles', [], 'html') /* line 12 */;
		echo '</head>

<body>
';
		foreach ($flashes as $flash) /* line 16 */ {
			echo '<div';
			echo ($ʟ_tmp = array_filter(['flash', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 16 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 16 */;
			echo '</div>
';

		}

		echo '
<nav class="navbar navbar-expand-md bg-body py-3"
     style="background: linear-gradient(179deg, #110077 0%, #16009d 100%);">
    <div class="container"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 20 */;
		echo '" class="navbar-brand d-flex align-items-center"><span
                    class="bs-icon-md justify-content-center align-items-center me-2 bs-icon"
                    style="background: url(&quot;/assets/img/books.png&quot;);background-size: contain;"></span><span
                    style="color: #ffffff;font-weight: bold;font-size: 22px;">Databáze knih</span></a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"
                style="border-color: rgba(255,255,255,0.65);"><span class="dropdown-burger"><svg viewBox="0 0 24 24"
                                                                                                 fill="none"
                                                                                                 xmlns="http://www.w3.org/2000/svg"><g
                            id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier"
                                                                           stroke-linecap="round"
                                                                           stroke-linejoin="round"></g><g
                            id="SVGRepo_iconCarrier"> <path d="M4 18L20 18" stroke="#ffffff" stroke-width="2"
                                                            stroke-linecap="round"></path> <path d="M4 12L20 12"
                                                                                                 stroke="#ffffff"
                                                                                                 stroke-width="2"
                                                                                                 stroke-linecap="round"></path> <path
                                d="M4 6L20 6" stroke="#ffffff" stroke-width="2"
                                stroke-linecap="round"></path> </g></svg></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 40 */;
		echo '" class="nav-link active" style="color: #ffffff;">Domů</a></li>
                <li class="nav-item"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Results:default')) /* line 41 */;
		echo '" class="nav-link" style="color: #ffffff;">Hledat</a></li>
                <li class="nav-item"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Categories:default')) /* line 42 */;
		echo '" class="nav-link" style="color: #ffffff;">Žánry</a></li>
            </ul>
            <form style="display: flex;"><input class="border rounded-0 form-control" type="search" name="book_search"
                                                placeholder="Hledat knihu"
                                                style="border-radius: 0px;border-style: solid;border-top-left-radius: 6px;border-bottom-left-radius: 6px;">
                <button class="btn btn-primary" type="button"
                        style="width: 60px;height: auto;padding: initial;border-style: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;background: rgb(0,107,167);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                         viewBox="0 0 16 16" class="bi bi-search" style="font-size: 23px;">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</nav>


';
		$this->renderBlock('content', [], 'html') /* line 60 */;
		echo '

<footer class="text-center" style="color: #21252933;">
        <div class="container text-muted py-4 py-lg-5 footer-container">
            <ul class="list-inline footer-list">
                <li class="list-inline-item me-4"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 66 */;
		echo '">Domů</a></li>
                <li class="list-inline-item me-4"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Results:default')) /* line 67 */;
		echo '">Hledat</a></li>
                <li class="list-inline-item"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Categories:default')) /* line 68 */;
		echo '">Žánry</a></li>
            </ul>
            <p class="mb-0">© 2025 | Tato webová stránka byla vytvořena Lukášem Seifertem jako součást maturitní práce.
                Web je určen pouze pro nekomerční účely.</p>
        </div>
</footer>

';
		$this->renderBlock('scripts', get_defined_vars()) /* line 75 */;
		echo '</body>
</html>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '16'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block scripts} on line 75 */
	public function blockScripts(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <script src="https://unpkg.com/nette-forms@3"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
';
		$this->renderBlock('scripts', get_defined_vars(), 'html') /* line 78 */;
	}
}
