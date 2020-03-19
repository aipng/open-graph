OpenGraph
=========
[![Build Status](https://travis-ci.org/aipng/open-graph.svg?branch=master)](https://travis-ci.org/aipng/open-graph)
[![Latest Stable Version](https://poser.pugx.org/aipng/open-graph/version)](https://packagist.org/packages/aipng/open-graph)
[![License](https://poser.pugx.org/aipng/open-graph/license)](https://packagist.org/packages/aipng/open-graph)

OpenGraph is an extra simple library for generating basic set of [Open Graph](https://ogp.me/) meta tags, inspired by Chris Konnertz's [Open Graph Builder](https://github.com/aipng/open-graph).

Example of usage:

Base
----
```php
use AipNg\OpenGraph\OpenGraph;
use AipNg\OpenGraph\MetaTags;
use AipNg\OpenGraph\MetaType;
use AipNg\ValueObjects\Web\Url;

$og = new OpenGraph;

$og
	->title('title')
	->type(MetaType::WEBSITE)
	->url(Url::from('https://site.com'))
	->image(Url::from('https://site.com/image.jpg'), 100, 200, 'image/jpg')
	->description('description')
	->siteName('site name');

var_dump($og->hasTag(MetaTags::OG_TITLE)); // true

$og->toArray();
```

Article
----
```php
use AipNg\OpenGraph\OpenGraph;

$og = new OpenGraph;

$og->article('title', new \DateTimeImmutable('2020-01-02 12:13:14'), 'section', ['tag-1', 'tag-2']);

$og->toArray();

/**
[
    'og:title' => 'title',
    'og:type' => 'article',
    'article:published_time' => '2020-01-02T12:13:14+0100',
    'article:section' => 'section',
    'article:tag' => [
        'tag-1',
        'tag-2',
    ],
];
*/
```
