<?php

declare(strict_types = 1);

namespace AipNg\OpenGraph;

use AipNg\ValueObjects\Web\Url;
use Nette\Utils\Strings;

final class OpenGraph
{

	/** @var string[]|array<string, string|string[]> */
	protected array $tags = [];


	public function hasTag(string $name): bool
	{
		return array_key_exists($name, $this->tags);
	}


	public function getTag(string $name): string
	{
		if (!$this->hasTag($name)) {
			throw new \InvalidArgumentException('Unknown tag name!');
		}

		return $this->tags[$name];
	}


	public function title(string $title): self
	{
		$title = Strings::trim($title);

		if (!$title) {
			throw new \InvalidArgumentException('Title is empty!');
		}

		$this->tags[MetaTags::OG_TITLE] = $title;

		return $this;
	}


	public function type(string $type): self
	{
		if (!MetaType::isValid($type)) {
			throw new \InvalidArgumentException(sprintf('Given type (%s) not supported!', $type));
		}

		$this->tags[MetaTags::OG_TYPE] = $type;

		return $this;
	}


	public function url(Url $url): self
	{
		$this->tags[MetaTags::OG_URL] = $url->getValue();

		return $this;
	}


	public function image(Url $url, ?int $width = null, ?int $height = null, ?string $type = null): self
	{
		$this->tags[MetaTags::OG_IMAGE] = $url->getValue();

		if ($width) {
			$this->tags[MetaTags::OG_IMAGE_WIDTH] = (string) $width;
		}

		if ($height) {
			$this->tags[MetaTags::OG_IMAGE_HEIGHT] = (string) $height;
		}

		if ($type) {
			$this->tags[MetaTags::OG_IMAGE_TYPE] = $type;
		}

		return $this;
	}


	public function description(string $description, int $maxLength = 250): self
	{
		$description = Strings::trim($description);

		$this->tags[MetaTags::OG_DESCRIPTION] = Strings::truncate($description, $maxLength);

		return $this;
	}


	public function locale(string $locale): self
	{
		$this->tags[MetaTags::OG_LOCALE] = $locale;

		return $this;
	}


	public function siteName(string $siteName): self
	{
		$siteName = Strings::trim($siteName);

		if (!$siteName) {
			throw new \InvalidArgumentException('Site name is empty!');
		}

		$this->tags[MetaTags::OG_SITE_NAME] = $siteName;

		return $this;
	}


	/**
	 * @param string $title
	 * @param \DateTimeImmutable|null $datePublished
	 * @param string|null $section
	 * @param string[] $articleTags
	 *
	 * @return \AipNg\OpenGraph\OpenGraph
	 */
	public function article(string $title, ?\DateTimeImmutable $datePublished = null, ?string $section = null, array $articleTags = []): self
	{
		$this
			->title($title)
			->type(MetaType::ARTICLE);

		if ($datePublished !== null) {
			$this->tags[MetaArticle::ARTICLE_PUBLISHED_TIME] = $datePublished->format(\DateTimeImmutable::ISO8601);
		}

		if ($section !== null) {
			$this->tags[MetaArticle::ARTICLE_SECTION] = $section;
		}

		foreach ($articleTags as $tag) {
			$this->tags[MetaArticle::ARTICLE_TAG][] = $tag;
		}

		return $this;
	}


	/**
	 * @return string[]|array<string, string>
	 */
	public function toArray(): array
	{
		return $this->tags;
	}

}
