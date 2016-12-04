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
use Thuata\IntercessionBundle\Exception\DuplicateUseFirstWithoutAliasException;
use Thuata\IntercessionBundle\Exception\DuplicateUseWithAliasException;
use Thuata\IntercessionBundle\Exception\InvalidNamespaceException;
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
    const USE_CLASS_EXTRACT_REGEXP = '#^(?P<namespace>([\w_]+\\\)*)(?P<classname>[\w_]+)$#';

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

    /**
     * @var array
     */
    private $uses;

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
        $this->uses = [];
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
    public function setName(string $name)
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
     * @return \Thuata\IntercessionBundle\Intercession\IntercessionClass
     * @throws \Thuata\IntercessionBundle\Exception\InvalidNamespaceException
     */
    public function setNamespace(string $namespace)
    {
        if (preg_match(self::USE_CLASS_EXTRACT_REGEXP, $namespace) === 0) {
            throw new InvalidNamespaceException($namespace);
        }
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
     * @param string $alias
     *
     * @return IntercessionClass
     *
     * @throws DuplicateUseWithAliasException
     */
    public function setExtends(string $extends, string $alias = null)
    {
        $this->extends = $this->addUse($extends, $alias);

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
     */
    public function addAuthor(string $name = null, string $email = null)
    {
        is_null($name) and $name = '';
        is_null($email) and $email = '';

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
     * @param string $alias
     *
     * @throws DuplicateUseWithAliasException
     */
    public function addInterface(string $interfaceName, string $alias = null)
    {
        $this->interfaces[] = $this->addUse($interfaceName, $alias);
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
     * @param string $traitName
     * @param string $alias
     *
     * @return IntercessionClass
     */
    public function addTrait(string $traitName, string $alias = null)
    {
        $this->traits[] = $this->addUse($traitName, $alias);

        return $this;
    }

    /**
     * @return array
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @param string $use
     * @param string $alias
     *
     * @return string the alias or class name
     *
     * @throws DuplicateUseFirstWithoutAliasException
     * @throws DuplicateUseWithAliasException
     * @throws InvalidNamespaceException
     */
    public function addUse(string $use, string $alias = null)
    {
        $this->repairUse($use);

        list($class, $namespace) = $this->extractClassNameFromUse($use);

        if ($namespace === $this->namespace) {
            return $class;
        }

        $found = array_key_exists($use, $this->uses) ? $this->uses[$use] : false;

        switch (true) {
            case $found === $alias : // already used, same alias (or no alias)
                break;
            case $found === null : // already used without alias but alias provided
                throw new DuplicateUseFirstWithoutAliasException($use, $alias);
            case $found === false : // never used
                $this->uses[$use] = ($alias !== $class) ? $alias : null;
                break;
            default : // already used with different alias
                throw new DuplicateUseWithAliasException($use, $alias, $found);
        }

        return $alias ?: $class;
    }

    /**
     * Removes leading \ from the use
     *
     * @param string $use
     */
    protected function repairUse(string &$use)
    {
        if (substr($use, 0, 1) === '\\') {
            $use = substr($use, 1);
        }
    }

    /**
     * Extracts the class name from a used namespaced class
     *
     * @param string $use
     *
     * @return mixed
     *
     * @throws InvalidNamespaceException
     */
    public function extractClassNameFromUse(string $use)
    {
        $matches = [];

        if (preg_match(self::USE_CLASS_EXTRACT_REGEXP, $use, $matches) === 0) {
            throw new InvalidNamespaceException($use);
        }

        $className = $matches['classname'];
        $namespace = array_key_exists('namespace', $matches) ? $matches['namespace'] : '';

        if (substr($namespace, -1, 1) === '\\') {
            $namespace = substr($namespace, 0, -1);
        }

        return [
            $className,
            $namespace
        ];
    }
}