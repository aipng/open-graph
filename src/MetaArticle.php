<?php

declare(strict_types = 1);

namespace AipNg\OpenGraph;

use MyCLabs\Enum\Enum;

/**
 * @extends \MyCLabs\Enum\Enum<string>
 */
final class MetaArticle extends Enum
{

	public const ARTICLE_PUBLISHED_TIME = 'article:published_time';
	public const ARTICLE_MODIFIED_TIME = 'article:modified_time';
	public const ARTICLE_AUTHOR = 'article:author';
	public const ARTICLE_SECTION = 'article:section';
	public const ARTICLE_TAG = 'article:tag';

}
