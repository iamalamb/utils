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

    public function testGetSubString()
    {
        $range = join('', range('A', 'Z'));

        $opts = [
            [
                'start'    => 0,
                'length'   => 5,
                'expected' => 'ABCDE',
            ],
            [
                'start'    => 2,
                'length'   => 10,
                'expected' => 'CDEFGHIJKL',
            ],
            [
                'start'    => 10,
                'length'   => null,
                'expected' => 'KLMNOPQRSTUVWXYZ',
            ],
            [
                'start'    => 0,
                'length'   => null,
                'expected' => $range,
            ],
            [
                'start'    => 5,
                'length'   => -5,
                'expected' => 'FGHIJKLMNOPQRSTU',
            ],
            [
                'start'    => Str::getLength($range) - 1,
                'length'   => null,
                'expected' => 'Z',
            ],
        ];

        $total = count($opts);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals(
                $opts[$i]['expected'],
                Str::getSubString($range, $opts[$i]['start'], $opts[$i]['length'])
            );
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

    public function testToUcFirst()
    {
        $strings = [
            [
                'original' => 'jason',
                'expected' => 'Jason',
            ],
            [
                'original' => 'jASON',
                'expected' => 'JASON',
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toUcFirst($strings[$i]['original']));
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
                'original' => 'yet another mixed_up-case-example',
                'expected' => 'YetAnotherMixedUpCaseExample',
            ],
            [
                'original' => 'yet another mixed_up-case-example 123',
                'expected' => 'YetAnotherMixedUpCaseExample123',
            ],
            [
                'original' => '123 yet another mixed_up-case-example',
                'expected' => '123YetAnotherMixedUpCaseExample',
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

    public function testToCamelCase()
    {
        $strings = [
            [
                'original' => 'jason',
                'expected' => 'jason',
            ],
            [
                'original' => 'JASON',
                'expected' => 'jason',
            ],
            [
                'original' => 'JASON Peter Lamb',
                'expected' => 'jasonPeterLamb',
            ],
            [
                'original' => 'snake_case_example',
                'expected' => 'snakeCaseExample',
            ],
            [
                'original' => 'kebab-case-example',
                'expected' => 'kebabCaseExample',
            ],
            [
                'original' => 'mixed_up-case-example',
                'expected' => 'mixedUpCaseExample',
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toCamelCase($strings[$i]['original']));
        }
    }

    public function testToKebabCase()
    {
        $strings = [
            [
                'original' => 'snake_case_example',
                'expected' => 'snake-case-example',
            ],
            [
                'original' => 'mixed_up-case-example',
                'expected' => 'mixed-up-case-example',
            ],
            [
                'original' => 'yet another mixed_up-case-example',
                'expected' => 'yet-another-mixed-up-case-example',
            ],
            [
                'original' => 'yet another mixed_up-case-example 123',
                'expected' => 'yet-another-mixed-up-case-example-123',
            ],
            [
                'original' => '123 yet another mixed_up-case-example',
                'expected' => '123-yet-another-mixed-up-case-example',
            ],
            [
                'original' => 0,
                'expected' => 0,
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toKebabCase($strings[$i]['original']));
        }
    }

    public function testToSnakeCase()
    {
        $strings = [
            [
                'original' => 'mixed_up-case-example',
                'expected' => 'mixed_up_case_example',
            ],
            [
                'original' => 'yet another mixed_up-case-example',
                'expected' => 'yet_another_mixed_up_case_example',
            ],
            [
                'original' => 'yet another mixed_up-case-example 123',
                'expected' => 'yet_another_mixed_up_case_example_123',
            ],
            [
                'original' => '123 yet another mixed_up-case-example',
                'expected' => '123_yet_another_mixed_up_case_example',
            ],
            [
                'original' => 0,
                'expected' => 0,
            ],
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toSnakeCase($strings[$i]['original']));
        }
    }
}
