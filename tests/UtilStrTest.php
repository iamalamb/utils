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

use PHPUnit\Framework\TestCase;
use Iamalamb\Utils\Str;

class UtilStrTest extends TestCase
{

    public function testGetClassName()
    {
        $classes = [
            'ClassA',
            'NameSpace\\ClassA',
            'NameSpace\\SubNameSpace\\ClassA',
            'NameSpace\\SubNameSpace\\ExtraSubNameSpace\\ClassA',
            'NameSpace\\SubNameSpace\\ExtraSubNameSpace\\YetAnotherSubNameSpace\\ClassA',
        ];

        $total = count($classes);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals('ClassA', Str::getClassName($classes[$i]));
        }
    }

    public function testToStudlyCase()
    {
        $strings = [
            [
                'original' => 'snake_case_example',
                'expected' => 'SnakeCaseExample',
            ],
            [
                'original' => 'kebab-case-example',
                'expected' => 'KebabCaseExample',
            ],
            [
                'original' => 'mixed_up-case-example',
                'expected' => 'MixedUpCaseExample',
            ],
            [
                'original' => 0,
                'expected' => 0,
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toStudlyCase($strings[$i]['original']));
        }
    }

    public function testToLowerCase()
    {
        $strings = [
            [
                'original' => 'this is A mixed up STRING',
                'expected' => 'this is a mixed up string',
            ],
            [
                'original' => 'THIS STRING IS IN UPPER CASE',
                'expected' => 'this string is in upper case',
            ],
            [
                'original' => 'üÜäÄsdsdafasdF€',
                'expected' => 'üüääsdsdafasdf€',
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toLowerCase($strings[$i]['original']));
        }
    }

    public function testToUpperCase()
    {
        $strings = [
            [
                'original' => 'this is A mixed up STRING',
                'expected' => 'THIS IS A MIXED UP STRING',
            ],
            [
                'original' => 'this string is in lower case',
                'expected' => 'THIS STRING IS IN LOWER CASE',
            ],
            [
                'original' => 'üäaBcDeF€',
                'expected' => 'ÜÄABCDEF€',
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toUpperCase($strings[$i]['original']));
        }
    }

    public function testToTitleCase()
    {
        $strings = [
            [
                'original' => 'this is A mixed up STRING',
                'expected' => 'This Is A Mixed Up String',
            ],
            [
                'original' => 'this string is in lower case',
                'expected' => 'This String Is In Lower Case',
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toTitleCase($strings[$i]['original']));
        }
    }

    public function testGetLength()
    {
        $strings = [
            [
                'original' => 'ABCDEFGHIJ',
                'expected' => 10,
            ],
            [
                'original' => 'ABCDE',
                'expected' => 5,
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::getLength($strings[$i]['original']));
        }

        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::getLength($strings[$i]['original'], 'UTF-8'));
        }

        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::getLength($strings[$i]['original'], 'ASCII'));
        }
    }

}
