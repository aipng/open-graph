<?php

declare(strict_types = 1);

namespace AipNg\OpenGraph;

use MyCLabs\Enum\Enum;

/**
 * @extends \MyCLabs\Enum\Enum<string>
 */
final class MetaTags extends Enum
{

	/** Basic Metadata */
	public const OG_TITLE = 'og:title';
	public const OG_TYPE = 'og:type';
	public const OG_IMAGE = 'og:image';
	public const OG_URL = 'og:url';

	/** Image metadata */
	public const OG_IMAGE_SECURE_URL = 'og:image:secure_url';
	public const OG_IMAGE_TYPE = 'og:image:type';
	public const OG_IMAGE_WIDTH = 'og:image:width';
	public const OG_IMAGE_HEIGHT = 'og:image:height';

	/** Optional metadata */
	public const OG_DESCRIPTION = 'og:description';
	public const OG_DETERMINER = 'og:determiner';
	public const OG_LOCALE = 'og:locale';
	public const OG_SITE_NAME = 'og:site_name';

}
