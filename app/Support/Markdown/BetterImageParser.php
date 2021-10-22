<?php

declare(strict_types=1);

namespace App\Support\Markdown;

use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

final class BetterImageParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex('% ([.\S]+)( \[(.+)\])?');
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();
        $previousChar = $cursor->peek(-1);

        if ($previousChar !== null && $previousChar !== ' ') {
            return false;
        }

        $cursor->advanceBy($inlineContext->getFullMatchLength());

        $matches = $inlineContext->getSubMatches();

        $inlineContext->getContainer()->appendChild(new Image($matches[0], $matches[2] ?? ''));

        return true;
    }
}
