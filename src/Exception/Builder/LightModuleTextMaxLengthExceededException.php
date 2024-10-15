<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Builder;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;

final class LightModuleTextMaxLengthExceededException extends \RuntimeException implements BuilderExceptionInterface
{
    public function __construct(MwuLightModuleInterface $lightModule, string $text, ?\Throwable $previous = null)
    {
        $message = sprintf(
            "Tried to set a text whose length exceeds the space available on the screen. Max length: %s.ext given: '%s'.",
            $text,
            $lightModule->getTextMaxLength(),
        );

        parent::__construct($message, 0, $previous);
    }
}
