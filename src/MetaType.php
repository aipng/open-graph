<?php

declare(strict_types = 1);

namespace AipNg\OpenGraph;

use MyCLabs\Enum\Enum;

/**
 * @extends \MyCLabs\Enum\Enum<string>
 */
final class MetaType extends Enum
{

	/** Base types */
	public const ARTICLE = 'article';
	public const PROFILE = 'profile';
	public const WEBSITE = 'website';

}
