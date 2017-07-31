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

    public function testThatGetClassNameReturnsAValidClassName()
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

    public function testThatToStudlyCaseConvertsCorrectly()
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
        ];

        $total = count($strings);
        for ($i = 0; $i < $total; $i++) {
            $this->assertEquals($strings[$i]['expected'], Str::toStudlyCase($strings[$i]['original']));
        }
    }
}