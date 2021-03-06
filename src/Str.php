<?php
/**
 * MIT License
 *
 * Copyright (c) 2017 Jason Lamb
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace Iamalamb\Utils;

/**
 * Class Str
 *
 * String based utility functions. Borrowed in part from
 * Laravel string helpers.
 *
 * @see https://laravel.com/docs/5.4/helpers#string
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class Str
{
    /**
     * Takes a fully qualified class name and
     * extracts just the basename.
     *
     * @param $class
     * @return string
     */
    public static function getClassName($class)
    {
        if (strpos($class, '\\') === false) {
            return $class;
        }

        return substr(strrchr($class, '\\'), 1);
    }

    /**
     * Gets the length of a given string
     * with an optional encoding.
     *
     * @param $value
     * @param null $encoding
     * @return int
     */
    public static function getLength($value, $encoding = null)
    {
        if ($encoding) {
            return mb_strlen($value, $encoding);
        }

        return mb_strlen($value);
    }

    /**
     * Extracts a substring using
     * forced UTF-8 encoding.
     *
     * @param $value
     * @param $start
     * @param null $length
     * @return string
     */
    public static function getSubString($value, $start, $length = null)
    {
        return mb_substr($value, $start, $length, 'UTF-8');
    }

    /**
     * Converts a string to camel case
     *
     * @param $value
     * @return string
     */
    public static function toCamelCase($value)
    {
        return lcfirst(static::toStudlyCase($value));
    }

    /**
     * Converts a string kebab case
     *
     * @param $value
     * @return mixed
     */
    public static function toKebabCase($value)
    {
        // First replace the potential non-word characters
        $value = preg_replace('/\W|_+/', '-', $value);

        return $value;
    }

    /**
     * Converts a string to lower case with
     * forced UTF-8 encoding.
     *
     * @param $value
     * @return string
     */
    public static function toLowerCase($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Converts a string to snake case
     *
     * @param $value
     * @return mixed
     */
    public static function toSnakeCase($value)
    {
        // First replace the potential non-word characters
        $value = preg_replace('/\W|_+/', '_', $value);

        return $value;
    }

    /**
     * Takes a string in either kebab case or snake case
     * and converts it to studly case.
     *
     * @param $value
     * @return string
     */
    public static function toStudlyCase($value)
    {
        // First replace the potential non-word characters
        $value = preg_replace('/\W|_+/', ' ', $value);

        $value = static::toLowerCase($value);

        $parts = explode(' ', $value);
        $parts = array_map(['static', 'toUcFirst'], $parts);

        $value = join('', $parts);

        return $value;
    }

    /**
     * Converts a string to title case with
     * forced UTF-8 encoding.
     *
     * @param $value
     * @return string
     */
    public static function toTitleCase($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * Converts a string to upper case with
     * forced UTF-8 encoding.
     *
     * @param $value
     * @return string
     */
    public static function toUpperCase($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * Converts the first character of a given string to
     * uppercase using UTF-8 encoding.
     *
     * @param $value
     * @return string
     */
    public static function toUcFirst($value)
    {
        return static::toUpperCase(static::getSubString($value, 0, 1)).static::getSubString($value, 1);
    }
}
