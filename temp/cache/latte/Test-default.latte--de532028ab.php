<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/mp/app/UI/Test/default.latte */
final class Template_de532028ab extends Latte\Runtime\Template
{
	public const Source = '/var/www/mp/app/UI/Test/default.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['book' => '21'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<style>
    .book{
        margin-bottom: 20px;
    }
</style>

<h1>Book by id</h1>
';
		foreach ($books as $book) /* line 21 */ {
			echo '<div class="book">
';
			if ($book['cover'] == 'Unknown') /* line 23 */ {
				echo '        <img src="https://via.placeholder.com/150">
';
			} else /* line 25 */ {
				echo '        <img src="';
				echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($book['cover'])) /* line 26 */;
				echo '">
';
			}
			echo '    <strong>';
			echo LR\Filters::escapeHtmlText($book['title']) /* line 28 */;
			echo '</strong><br>
    <em>';
			echo LR\Filters::escapeHtmlText($book['authors']) /* line 29 */;
			echo '</em><br>
    <p>';
			echo LR\Filters::escapeHtmlText($book['publishedDate']) /* line 30 */;
			echo '</p>
    ';
			echo LR\Filters::escapeHtmlText(($this->filters->stripHtml)($book['description'])) /* line 31 */;
			echo '<br>
    <p>';
			echo LR\Filters::escapeHtmlText($book['pageCount']) /* line 32 */;
			echo '</p>
    <p>';
			echo LR\Filters::escapeHtmlText($book['categories']) /* line 33 */;
			echo '</p>
    <p>';
			echo LR\Filters::escapeHtmlText($book['averageRating']) /* line 34 */;
			echo '</p>
    <p>';
			echo LR\Filters::escapeHtmlText($book['ratingsCount']) /* line 35 */;
			echo '</p>
</div>
';

		}
	}
}
