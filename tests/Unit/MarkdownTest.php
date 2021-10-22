<?php

use App\Support\Markdown\Markdown;
use Tests\TestCase;

uses(TestCase::class);

test('it can be constructed', function () {
    expect(new Markdown)->toBeInstanceOf(Markdown::class);
});

test('it can convert autolinks into a tags', function () {
    $markdown = new Markdown;

    expect($markdown->convert('<https://google.com>'))
        ->toBeString()
        ->toContain('<a rel="noopener noreferrer" target="_blank" href="https://google.com">');
});

test('it can convert better image syntax into img tags', function () {
    $markdown = new Markdown;

    expect($markdown->convert('% https://picsum.photos/200'))
        ->toBeString()
        ->toContain('<img src="https://picsum.photos/200" alt="" />');
});

test('it can convert better image syntax with alt tag into img tags', function () {
    $markdown = new Markdown;

    expect($markdown->convert('% https://picsum.photos/200 [FooBar]'))
        ->toBeString()
        ->toContain('<img src="https://picsum.photos/200" alt="FooBar" />');
});
