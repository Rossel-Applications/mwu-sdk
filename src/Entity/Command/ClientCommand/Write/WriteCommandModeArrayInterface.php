<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ClientCommand\Write;

/**
 * Interface for the representation of the mode array in the `P5` MWU command.
 *
 * This interface defines the methods to access the various mode fields (M1, M2, M3) used in the MWU command,
 * which control specific display or functional settings for the MWU Light Module.
 */
interface WriteCommandModeArrayInterface
{
    /**
     * Get the M1 value in the mode array.
     *
     * @return ?string the M1 value, or null if not set
     */
    public function getM1(): ?string;

    /**
     * Get the M2 value in the mode array.
     *
     * @return ?string the M2 value, or null if not set
     */
    public function getM2(): ?string;

    /**
     * Get the M3 value in the mode array.
     *
     * @return ?string the M3 value, or null if not set
     */
    public function getM3(): ?string;

    /**
     * Convert the mode array to a string format.
     *
     * @return string a concatenated string of M1, M2, and M3 values
     */
    public function __toString(): string;
}
