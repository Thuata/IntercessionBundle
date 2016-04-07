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
use Symfony\Component\Validator\Mapping\Factory\MetadataFactoryInterface;
use Thuata\IntercessionBundle\Exception\AuthorNoDataException;
use Thuata\IntercessionBundle\Exception\AuthorWrongTypeException;
use Thuata\IntercessionBundle\Intercession\IntercessionClass;

/**
 * Class IntercessionClassTest
 *
 * @package Thuata\IntercessionBundle\Tests\Intercession
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class IntercessionClassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for author with name and email
     */
    public function testAddIntercessionClassAuthor()
    {
        $class = new IntercessionClass();

        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');

        $expected = 'Anthony Maudry <anthony.maudry@thuata.com>';

        $this->assertEquals($expected, $class->getAuthors()[0]);
    }

    /**
     * Test for author with name only
     */
    public function testAddIntercessionClassAuthorName()
    {
        $class = new IntercessionClass();

        $class->addAuthor('Anthony Maudry', null);

        $expected = 'Anthony Maudry';

        $this->assertEquals($expected, $class->getAuthors()[0]);
    }

    /**
     * Test for author with email only
     */
    public function testAddIntercessionClassAuthorEmail()
    {
        $class = new IntercessionClass();

        $class->addAuthor(null, 'anthony.maudry@thuata.com');

        $expected = '<anthony.maudry@thuata.com>';

        $this->assertEquals($expected, $class->getAuthors()[0]);
    }

    /**
     * Test for author with name and email
     *
     * @expectedException \Thuata\IntercessionBundle\Exception\AuthorNoDataException
     */
    public function testAddIntercessionClassAuthorNone()
    {
        $class = new IntercessionClass();

        $class->addAuthor();
    }

    /**
     * Test for author with name and email
     *
     * @expectedException \Thuata\IntercessionBundle\Exception\AuthorWrongTypeException
     */
    public function testAddIntercessionClassAuthorWrongName()
    {
        $class = new IntercessionClass();

        $class->addAuthor(2, 'anthony.maudry@thuata.com');
    }

    /**
     * Test for author with name and email
     *
     * @expectedException \Thuata\IntercessionBundle\Exception\AuthorWrongTypeException
     */
    public function testAddIntercessionClassAuthorWrongEmail()
    {
        $class = new IntercessionClass();

        $class->addAuthor('Anthony Maudry', 3);
    }
}