<?php

declare(strict_types=1);

namespace Albin\ExtractorBundle;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.extractor')]
interface ExtractorInterface
{
    public function supports(string $fruit): bool;

    public function displayExtraction(string $fruit): string;
}
