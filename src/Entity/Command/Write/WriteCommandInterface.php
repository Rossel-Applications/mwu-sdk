<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\Write;

use MwuSdk\Entity\Command\TargetedLightModuleCommandInterface;

/**
 * Interface for write commands sent to the MWU Light Module.
 *
 * Extends the basic command functionalities by providing specific methods related to writing data on the screen and configuring display options such as light color and button behavior.
 */
interface WriteCommandInterface extends TargetedLightModuleCommandInterface
{
}
