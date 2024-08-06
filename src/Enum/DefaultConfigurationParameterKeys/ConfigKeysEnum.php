<?php

declare(strict_types=1);

namespace MwuSdk\Enum\DefaultConfigurationParameterKeys;

enum ConfigKeysEnum: string
{
    case OPTIONAL_ENCAPSULATING_KEY = 'mwu_default_config';
    case KEY_SWITCHES = 'switches';
    case KEY_BEHAVIOR = 'behavior';
}
