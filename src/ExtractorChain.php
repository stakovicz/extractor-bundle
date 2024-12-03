<?php

declare(strict_types=1);

namespace Albin\ExtractorBundle;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

#[AsAlias(id: ExtractorInterface::class, public: true)]
final class ExtractorChain implements ExtractorInterface
{
    /**
     * @param ExtractorInterface[] $extractors
     */
    public function __construct(
        #[AutowireIterator('app.extractor', exclude: self::class)]
        private readonly iterable $extractors
    ) {}

    public function displayExtraction(string $fruit): string
    {
        foreach ($this->extractors as $extractor) {
            if ($extractor->supports($fruit)) {
                return $extractor->displayExtraction($fruit);
            }
        }

        throw new \RuntimeException("No extractor of type '$fruit' found.");
    }

    public function supports(string $fruit): bool
    {
        foreach ($this->extractors as $extractor) {
            if ($extractor->supports($fruit)) {
                return true;
            }
        }

        return false;
    }
}
