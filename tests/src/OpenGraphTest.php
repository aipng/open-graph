<?php

declare(strict_types = 1);

namespace AipNg\OpenGraphTests;

use AipNg\OpenGraph\MetaTags;
use AipNg\OpenGraph\MetaType;
use AipNg\OpenGraph\OpenGraph;
use AipNg\ValueObjects\Web\Url;
use PHPUnit\Framework\TestCase;

final class OpenGraphTest extends TestCase
{

	public function testMetadata(): void
	{
		$og = new OpenGraph;
		$og
			->title('title')
			->type(MetaType::WEBSITE)
			->url(Url::from('https://site.com'))
			->image(Url::from('https://site.com/image.jpg'), 100, 200, 'image/jpg')
			->description('description')
			->siteName('site name');

		$this->assertTrue($og->hasTag(MetaTags::OG_TITLE), 'Missing title tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_TYPE), 'Missing type tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_URL), 'Missing url tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_IMAGE), 'Missing image tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_IMAGE_WIDTH), 'Missing image width tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_IMAGE_HEIGHT), 'Missing image height tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_IMAGE_TYPE), 'Missing image type tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_DESCRIPTION), 'Missing description tag!');
		$this->assertTrue($og->hasTag(MetaTags::OG_SITE_NAME), 'Missing site name tag!');

		$result = [
			'og:title' => 'title',
			'og:type' => 'website',
			'og:url' => 'https://site.com',
			'og:image' => 'https://site.com/image.jpg',
			'og:image:width' => '100',
			'og:image:height' => '200',
			'og:image:type' => 'image/jpg',
			'og:description' => 'description',
			'og:site_name' => 'site name',
		];

		$this->assertEquals($result, $og->toArray());
	}


	public function testGetTag(): void
	{
		$og = new OpenGraph;

		$og->title('title');

		$this->assertSame('title', $og->getTag(MetaTags::OG_TITLE));
	}


	public function testTitleCannotBeEmpty(): void
	{
		$og = new OpenGraph;

		$this->expectException(\InvalidArgumentException::class);

		$og->title(' ');
	}


	public function testRefuseUnknownOpenGraphType(): void
	{
		$og = new OpenGraph;

		$this->expectException(\InvalidArgumentException::class);

		$og->type('unknown');
	}


	public function testSiteNameCannotBeEmpty(): void
	{
		$og = new OpenGraph;

		$this->expectException(\InvalidArgumentException::class);

		$og->siteName(' ');
	}

}
