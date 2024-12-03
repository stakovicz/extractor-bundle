<?php

declare(strict_types=1);

namespace Albin\ExtractorBundle;

use Twig\Environment;

final class AgrumeExtractor implements ExtractorInterface
{
    public function __construct(private readonly Environment $twig)
    {
    }

    public function supports(string $fruit): bool
    {
        return 'agrume' === $fruit;
    }

    public function displayExtraction(string $fruit): string
    {
        return $this->twig->render('extractor.html.twig', ['extractor' => $this]);
    }
}
