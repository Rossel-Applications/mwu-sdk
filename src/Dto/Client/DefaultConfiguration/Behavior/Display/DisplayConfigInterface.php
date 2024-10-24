<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display;

interface DisplayConfigInterface
{
    public function getLight(): LightConfigInterface;

    public function getScreen(): ScreenConfigInterface;
}
