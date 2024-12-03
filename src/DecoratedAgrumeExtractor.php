<?php

declare(strict_types=1);

namespace Albin\ExtractorBundle;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Twig\Environment;

#[AsDecorator(decorates: AgrumeExtractor::class)]
final class DecoratedAgrumeExtractor implements ExtractorInterface
{
    public function __construct(
        private readonly Environment $twig,
        #[AutowireDecorated] private readonly ExtractorInterface $inner
    ) {
    }

    public function supports(string $fruit): bool
    {
        return $this->inner->supports($fruit);
    }

    public function displayExtraction(string $fruit): string
    {
        return $this->twig->render('agrume.html.twig', ['inner' => $this->inner->displayExtraction($fruit)]);
    }
}
