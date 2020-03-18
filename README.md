OpenGraph
=========
[![Build Status](https://travis-ci.org/aipng/open-graph.svg?branch=master)](https://travis-ci.org/aipng/open-graph)
[![Latest Stable Version](https://poser.pugx.org/aipng/open-graph/version)](https://packagist.org/packages/aipng/open-graph)
[![License](https://poser.pugx.org/aipng/open-graph/license)](https://packagist.org/packages/aipng/open-graph)

OpenGraph is an extra simple library for generating basic set of [Open Graph](https://ogp.me/) meta tags, inspired by Chris Konnertz's [Open Graph Builder](https://github.com/aipng/open-graph).

Example of usage:

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
