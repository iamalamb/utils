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
 * String based utility functions. Borrowed extensively in part from
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
     */
    public static function getClassName($class)
    {
        if (strpos($class, '\\') === false) {
            return $class;
        }

        return substr(strrchr($class, '\\'), 1);
    }
}