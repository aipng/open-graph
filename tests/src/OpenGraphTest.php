<?php

declare(strict_types = 1);

namespace AipNg\OpenGraphTests;

use AipNg\OpenGraph\MetaArticle;
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


	public function testArticle(): void
	{
		$og = new OpenGraph;
		$og->article('title', new \DateTimeImmutable('2020-01-02 12:13:14', new \DateTimeZone('Europe/Prague')), 'section', ['tag-1', 'tag-2']);

		$this->assertTrue($og->hasTag(MetaTags::OG_TITLE), 'Missing title tag!');
		$this->assertTrue($og->hasTag(MetaArticle::ARTICLE_PUBLISHED_TIME), 'Missing published datetime tag!');
		$this->assertTrue($og->hasTag(MetaArticle::ARTICLE_SECTION), 'Missing section tag!');
		$this->assertTrue($og->hasTag(MetaArticle::ARTICLE_TAG), 'Missing article tag tag!');

		$result = [
			'og:title' => 'title',
			'og:type' => 'article',
			'article:published_time' => '2020-01-02T12:13:14+0100',
			'article:section' => 'section',
			'article:tag' => [
				'tag-1',
				'tag-2',
			],
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
