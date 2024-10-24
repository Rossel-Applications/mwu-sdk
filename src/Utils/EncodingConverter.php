<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Utils;

use Rossel\MwuSdk\Exception\Utils\EncodingConverter\InvalidArgumentFormatException;

/**
 * Class EncodingConverter.
 *
 * A utility class for converting between different encoding formats, including:
 * - Binary to ASCII
 * - ASCII to Binary
 * - Binary to Hexadecimal
 * - Hexadecimal to Binary
 * - Hexadecimal to ASCII
 * - ASCII to Hexadecimal
 * - Binary to Decimal
 * - Decimal to Binary
 *
 * This class provides static methods for converting between these formats and ensures
 * that the input is properly validated before conversion.
 */
final readonly class EncodingConverter
{
    /**
     * Convert a binary string to its ASCII representation.
     *
     * @param string $binary a binary string with a length that is a multiple of 8
     *
     * @throws InvalidArgumentFormatException if the binary string length is not a multiple of 8
     *
     * @return string the ASCII representation of the binary string
     */
    public static function binaryToAscii(string $binary): string
    {
        if (0 !== \strlen($binary) % 8) {
            throw new InvalidArgumentFormatException('binary', 'Expected a string with a length that is a multiple of 8.');
        }

        $ascii = '';
        $binaryArray = str_split($binary, 8);

        foreach ($binaryArray as $octet) {
            $ascii .= \chr((int) bindec($octet));
        }

        return $ascii;
    }

    /**
     * Convert an ASCII string to its binary representation.
     *
     * @param string $ascii the ASCII string to convert
     *
     * @return string the binary representation of the ASCII string
     */
    public static function asciiToBinary(string $ascii): string
    {
        $binary = '';

        foreach (str_split($ascii) as $char) {
            $binary .= str_pad(decbin(\ord($char)), 8, '0', \STR_PAD_LEFT);
        }

        return $binary;
    }

    /**
     * Convert a binary string to its hexadecimal representation.
     *
     * @param string $binary the binary string to convert
     *
     * @return string the hexadecimal representation of the binary string
     */
    public static function binaryToHex(string $binary): string
    {
        return dechex((int) bindec($binary));
    }

    /**
     * Convert a hexadecimal string to its binary representation.
     *
     * @param string $hex the hexadecimal string to convert
     *
     * @return string the binary representation of the hexadecimal string
     */
    public static function hexToBinary(string $hex): string
    {
        return str_pad(decbin((int) hexdec($hex)), \strlen($hex) * 4, '0', \STR_PAD_LEFT);
    }

    /**
     * Convert a hexadecimal string to its ASCII representation.
     *
     * @param string $hex the hexadecimal string to convert
     *
     * @return string the ASCII representation of the hexadecimal string
     */
    public static function hexToAscii(string $hex): string
    {
        $ascii = '';
        $hexArray = str_split($hex, 2);

        foreach ($hexArray as $hexByte) {
            $ascii .= \chr((int) hexdec($hexByte));
        }

        return $ascii;
    }

    /**
     * Convert an ASCII string to its hexadecimal representation.
     *
     * @param string $ascii the ASCII string to convert
     *
     * @return string the hexadecimal representation of the ASCII string
     */
    public static function asciiToHex(string $ascii): string
    {
        $hex = '';

        foreach (str_split($ascii) as $char) {
            $hex .= dechex(\ord($char));
        }

        return strtoupper($hex);
    }

    /**
     * Convert a binary string to its decimal representation.
     *
     * @param string $binary the binary string to convert
     *
     * @return int the decimal representation of the binary string
     */
    public static function binaryToDec(string $binary): int
    {
        return (int) bindec($binary);
    }

    /**
     * Convert a decimal number to its binary string representation.
     *
     * @param int $decimal the decimal number to convert
     *
     * @return string the binary string representation of the decimal number
     */
    public static function decToBinary(int $decimal): string
    {
        return decbin($decimal);
    }
}
