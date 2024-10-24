<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches;

enum SwitchesConfigKeysEnum: string
{
    case ITEM_KEY_IP_ADDRESS = 'ip_address';
    case ITEM_KEY_IP_PORT = 'port';
    case ITEM_KEY_LIGHT_MODULES_GENERATOR = 'light_modules_generator';
}
