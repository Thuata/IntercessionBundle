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

namespace Thuata\IntercessionBundle\Intercession;

use Thuata\IntercessionBundle\Interfaces\DescriptableInterface;
use Thuata\IntercessionBundle\Interfaces\VisibilityableInterface;
use Thuata\IntercessionBundle\Traits\DescriptableTrait;
use Thuata\IntercessionBundle\Traits\VisibilityableTrait;

/**
 * Class IntercessionMethod
 *
 * @package Thuata\IntercessionBundle
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class IntercessionMethod implements VisibilityableInterface, DescriptableInterface
{
    use VisibilityableTrait, DescriptableTrait;
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var string
     */
    private $typeReturned;

    /**
     * IntercessionMethod constructor.
     */
    public function __construct()
    {
        $this->name = '';
        $this->body = '';
        $this->setDescription('');
        $this->parameters = [];
        $this->typeReturned = '';
        $this->visibility = self::VISIBILITY_PUBLIC;
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     *
     * @return IntercessionMethod
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets the body
     *
     * @param string $body
     *
     * @return IntercessionMethod
     */
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Gets the type returned
     *
     * @return string
     */
    public function getTypeReturned()
    {
        return $this->typeReturned;
    }

    /**
     * Sets the type returned
     *
     * @param string $typeReturned
     *
     * @return IntercessionMethod
     */
    public function setTypeReturned(string $typeReturned)
    {
        $this->typeReturned = $typeReturned;

        return $this;
    }

    /**
     * Gets the parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Adds a parameter
     *
     * @param IntercessionVar $parameter
     *
     * @return IntercessionMethod
     */
    public function addParameter(IntercessionVar $parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }
}