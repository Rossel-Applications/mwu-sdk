<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ClientCommand\Write;

/**
 * Implementation of the mode array in the `P5` MWU command.
 *
 * This class represents the specific mode values (M1, M2, M3) used in the MWU command,
 * allowing customization of light colors, display settings, and more for the MWU Light Module.
 *
 * For more details on how these modes affect the module's behavior, refer to the MWU reference documentation.
 */
final readonly class WriteCommandModeArray implements WriteCommandModeArrayInterface
{
    /**
     * @param ?string $m1 the first mode value (M1), or null if not set
     * @param ?string $m2 the second mode value (M2), or null if not set
     * @param ?string $m3 the third mode value (M3), or null if not set
     */
    public function __construct(
        private ?string $m1 = null,
        private ?string $m2 = null,
        private ?string $m3 = null,
        private ?string $ma = null,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getM1(): ?string
    {
        return $this->m1;
    }

    /**
     * {@inheritDoc}
     */
    public function getM2(): ?string
    {
        return $this->m2;
    }

    /**
     * {@inheritDoc}
     */
    public function getM3(): ?string
    {
        return $this->m3;
    }

    public function getMa(): ?string
    {
        return $this->ma;
    }

    /**
     * {@inheritDoc}
     *
     * Concatenate the M1, M2, and M3 values into a string.
     *
     * @return string a concatenated string of the mode values, empty strings for any null values
     */
    public function __toString(): string
    {
        $m1 = $this->getM1() ?? '';
        $m2 = $this->getM2() ?? '';
        $m3 = $this->getM3() ?? '';
        $ma = $this->getMa() ?? '';

        return $m1.$m2.$m3.$ma;
    }
}
