<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client\LightModule;

use MwuSdk\Client\MwuLightModuleInterface;

final class UnreachableLightModuleException extends \RuntimeException implements LightModuleClientException
{
    public const DETAILS_MISSING_ID = 'Light module id is missing';
    public const DETAILS_MISSING_SWITCH = 'Switch is required';

    public function __construct(
        private readonly MwuLightModuleInterface $lightModule,
        ?string $details = null,
        ?\Throwable $previous = null
    ) {
        $message = sprintf(
            'Unreachable Light Module%s.',
            null === $details ? ': '.$details : ''
        );

        parent::__construct($message, 0, $previous);
    }

    public function getLightModule(): MwuLightModuleInterface
    {
        return $this->lightModule;
    }
}
