<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display;

final readonly class DisplayConfig implements DisplayConfigInterface
{
    public function __construct(
        private LightConfigInterface $light,
        private ScreenConfigInterface $screen,
    ) {
    }

    public function getLight(): LightConfigInterface
    {
        return $this->light;
    }

    public function getScreen(): ScreenConfigInterface
    {
        return $this->screen;
    }
}
