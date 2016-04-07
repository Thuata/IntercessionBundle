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

use Thuata\IntercessionBundle\Exception\AuthorNoDataException;
use Thuata\IntercessionBundle\Exception\AuthorWrongTypeException;
use Thuata\IntercessionBundle\Intercession\IntercessionVar\IntercessionProperty;
use Thuata\IntercessionBundle\Interfaces\DescriptableInterface;
use Thuata\IntercessionBundle\Traits\DescriptableTrait;

/**
 * Class IntercessionClass
 *
 * @package Thuata\IntercessionBundle
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class IntercessionClass implements DescriptableInterface
{
    use DescriptableTrait;

    const ERROR_FORMAT_NON_EXISTANT_INTERFACE = 'Interface "%s" is not defined';
    const FORMAT_AUTHOR = '%s <%s>';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var array
     */
    private $authors;

    /**
     * @var array
     */
    private $properties;

    /**
     * @var array
     */
    private $methods;

    /**
     * @var string
     */
    private $extends;

    /**
     * @var array
     */
    private $interfaces;

    /**
     * @var array
     */
    private $traits;

    public function __construct()
    {
        $this->name = null;
        $this->description = null;
        $this->authors = [];
        $this->properties = [];
        $this->methods = [];
        $this->extends = null;
        $this->interfaces = [];
        $this->traits = [];
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param string $name
     *
     * @return IntercessionClass
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets name
     *
     * @param string $namespace
     *
     * @return IntercessionClass
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Gets extends
     *
     * @return string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets extends
     *
     * @param string $extends
     *
     * @return IntercessionClass
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;
        return $this;
    }

    /**
     * Gets the authors
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Adds an author
     *
     * @param string $name
     * @param string $email
     *
     * @return IntercessionClass
     *
     * @throws AuthorNoDataException
     * @throws AuthorWrongTypeException
     */
    public function addAuthor($name = null, $email = null)
    {
        is_null($name) and $name = '';
        is_null($email) and $email = '';

        if (!is_string($name) or !is_string($email)) {
            throw new AuthorWrongTypeException($name, $email);
        }

        if (empty($name) and empty($email)) {
            throw new AuthorNoDataException();
        }

        if (!empty($email)) {
            $author = trim(sprintf(self::FORMAT_AUTHOR, $name, $email));
        } else {
            $author = trim($name);
        }

        $this->authors[] = $author;

        return $this;
    }

    /**
     * Gets the properties
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Adds a property
     *
     * @param IntercessionProperty $property
     *
     * @return IntercessionClass
     */
    public function addProperty(IntercessionProperty $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * Gets the methods
     *
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * Adds a method
     *
     * @param IntercessionMethod $method
     *
     * @return IntercessionClass
     */
    public function addMethod(IntercessionMethod $method)
    {
        $this->methods[] = $method;

        return $this;
    }

    /**
     * Gets the Interfaces
     *
     * @return array
     */
    public function getInterfaces()
    {
        return $this->interfaces;
    }

    /**
     * Adds an interface
     *
     * @param string $interfaceName
     */
    public function addInterface($interfaceName)
    {
        $this->interfaces[] = $interfaceName;
    }

    /**
     * Gets the traits
     *
     * @return array
     */
    public function getTraits()
    {
        return $this->traits;
    }

    /**
     * Adds a trait
     *
     * @param $traitName
     *
     * @return IntercessionClass
     */
    public function addTrait($traitName)
    {
        $this->traits[] = $traitName;

        return $this;
    }
}