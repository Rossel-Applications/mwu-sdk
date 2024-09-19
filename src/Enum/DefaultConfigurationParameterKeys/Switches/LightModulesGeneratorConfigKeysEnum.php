<?php

declare(strict_types=1);

namespace MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches;

enum LightModulesGeneratorConfigKeysEnum: string
{
    case KEY_FIRST_MODULE_ID = 'first_module_id';
    case KEY_INCREMENT_BETWEEN_MODULE_IDS = 'increment_between_module_ids';
    case KEY_NUMBER_OF_MODULES = 'number_of_modules';
}
