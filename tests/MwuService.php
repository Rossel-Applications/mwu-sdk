<?php

declare(strict_types=1);

namespace MwuSdkTest;

use MwuSdk\Client\MwuService;
use MwuSdk\Factory\Client\MwuSwitchFactory;
use MwuSdk\Serializer\DefaultConfiguration\Formats\YamlConfigurationDeserializer;

class MwuService extends MwuService
{
    private const YAML_CONFIG_FILE_PATH = '/config/test_config.yaml';

    private static ?self $instance = null;

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

    public static function getInstance(
        MwuSwitchFactory $switchFactory,
        YamlConfigurationDeserializer $configurationDeserializer
    ): self {
        if (null === static::$instance) {
            static::$instance = new self($switchFactory, $configurationDeserializer);
            static::$instance->configure();
        }

        return static::$instance;
    }
}
