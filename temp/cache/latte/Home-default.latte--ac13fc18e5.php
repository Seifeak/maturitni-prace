<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/mp/app/UI/Home/default.latte */
final class Template_ac13fc18e5 extends Latte\Runtime\Template
{
	public const Source = '/var/www/mp/app/UI/Home/default.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}
	}
}
