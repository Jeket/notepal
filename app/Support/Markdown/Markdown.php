<?php

declare(strict_types=1);

namespace App\Support\Markdown;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

final class Markdown
{
    public function convert(string $markdown): string
    {
        $environment = new Environment([
            'external_link' => [
                'internal_hosts' => config('app.url'),
                'open_in_new_window' => true,
            ],
        ]);

        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new ExternalLinkExtension);
        $environment->addExtension(new BetterImageExtension);

        $converter = new MarkdownConverter($environment);

        return $converter->convertToHtml($markdown)->getContent();
    }
}
