<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys;

enum ConfigKeysEnum: string
{
    case OPTIONAL_ENCAPSULATING_KEY = 'mwu_sdk';
    case KEY_SWITCHES = 'switches';
    case KEY_BEHAVIOR = 'behavior';
}
