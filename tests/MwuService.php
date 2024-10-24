<?php

declare(strict_types=1);

namespace MwuSdkTest;

use MwuSdk\Factory\Client\MwuSwitchFactory;
use MwuSdk\Serializer\DefaultConfiguration\Formats\YamlConfigurationDeserializer;

class MwuService extends \MwuSdk\Client\Mwu\Mwu
{
    private const YAML_CONFIG_FILE_PATH = '/config/test_config.yaml';

    public function __construct(
        MwuSwitchFactory $switchFactory,
        YamlConfigurationDeserializer $configurationDeserializer
    ) {
        parent::__construct($switchFactory, $configurationDeserializer);
    }

    public function configure(): void
    {
        $this->loadYamlConfigurationFile(__DIR__.self::YAML_CONFIG_FILE_PATH);
    }
}