<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/mp/app/UI/Test/default.latte */
final class Template_9f9e6e9f5d extends Latte\Runtime\Template
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
			foreach (array_intersect_key(['book' => '27'], $this->params) as $ʟ_v => $ʟ_l) {
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

';
		foreach ($books as $book) /* line 27 */ {
			echo '    <strong>';
			echo LR\Filters::escapeHtmlText($book['title']) /* line 28 */;
			echo '</strong><br>
';

		}
	}
}
