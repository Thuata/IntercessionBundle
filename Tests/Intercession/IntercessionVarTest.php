<?php
/*
 * The MIT License
 *
 * Copyright 2015 Anthony Maudry <anthony.maudry@thuata.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Thuata\IntercessionBundle\Tests\Intercession;

use Thuata\IntercessionBundle\Intercession\IntercessionVar;

/**
 * Class IntercessionVarTest
 *
 * @package Thuata\IntercessionBundle\Tests\Intercession
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class IntercessionVarTest extends \PHPUnit_Framework_TestCase
{
    public function testIntercerssionVarTypeIsClass()
    {
        $var = new IntercessionVar();
        $var->setName('bar');
        $var->setType('\\Bar');

        $this->assertTrue($var->isTypeClassName());
    }

    public function testIntercerssionVarTypeIsClassNoSlash()
    {
        $var = new IntercessionVar();
        $var->setName('bar');
        $var->setType('Bar');

        $this->assertTrue($var->isTypeClassName());
    }

    public function testIntercerssionVarTypeIsClassLong()
    {
        $var = new IntercessionVar();
        $var->setName('bar');
        $var->setType('\\FooBar');

        $this->assertTrue($var->isTypeClassName());
    }

    public function testIntercerssionVarTypeIsClassIntAndUnderscore()
    {
        $var = new IntercessionVar();
        $var->setName('bar');
        $var->setType('\\Foo2_BarBaz');

        $this->assertTrue($var->isTypeClassName());
    }

    public function testIntercerssionVarTypeIsClassNotClass()
    {
        $var = new IntercessionVar();
        $var->setName('bar');
        $var->setType('bazbar');

        $this->assertFalse($var->isTypeClassName());
    }
}