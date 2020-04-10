<?php

namespace App\Helper;

use Ramsey\Uuid\Uuid;

/**
 * @return string
 */
function uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

/**
 * @param $value
 *
 * @return string
 */
function encodeUuid($value): string
{
    return Uuid::fromString($value)->getBytes();
}

/**
 * @param $value
 *
 * @return string
 */
function decodeUuid($value): string
{
    return Uuid::fromBytes($value)->toString();
}

/**
 * @param string $content
 *
 * @return bool
 */
function is_binary($content)
{
    if (!is_scalar($content)) {
        return false;
    }
    return preg_match('~[^\x20-\x7E\t\r\n]~', stripAccents($content)) > 0;
}

/**
 * @param string $withAccents
 *
 * @return string
 */
function stripAccents(string $withAccents): string
{
    return strtr(
        $withAccents,
        'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
        'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'
    );
}

/**
 * @param $path
 *
 * @return string
 */
function url($path)
{
    return env('APP_URL') . str_replace('//', '/', "/{$path}");
}

/**
 * @param string $property
 * @param string $message
 * @param $value
 * @param array $parameters
 * @param null $code
 *
 * @return array
 */
function error(string $property, string $message, $value, $parameters = [], $code = null)
{
    return [
        'property_path' => $property,
        'message' => $message,
        'value' => $value,
        'parameters' => $parameters,
        'code' => $code,
    ];
}
