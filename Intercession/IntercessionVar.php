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
use Thuata\IntercessionBundle\Traits\DescriptableTrait;

/**
 * Class IntercessionVar
 *
 * @package thuata\intercessionbundle
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class IntercessionVar implements DescriptableInterface
{
    use DescriptableTrait;

    const PATTERN_CLASS = '#^(\\\\?[A-Z]+[\w_]+)+$#';
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $initilisation;

    /**
     * IntercessionVar constructor.
     */
    public function __construct()
    {
        $this->name = '';
        $this->type = '';
        $this->initilisation = '';
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
     * sets the name
     *
     * @param string $name
     * @return IntercessionVar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param string $type
     * @return IntercessionVar
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the initialisation value
     *
     * @return string
     */
    public function getInitilisation()
    {
        return $this->initilisation;
    }

    /**
     * Sets the initialisation value
     *
     * @param string $initialisation
     *
     * @return IntercessionVar
     */
    public function setInitilisation($initialisation)
    {
        $this->initilisation = $initialisation;

        return $this;
    }

    /**
     * Checks if type is a class name
     *
     * @return bool
     */
    public function isTypeClassName()
    {
        return preg_match(self::PATTERN_CLASS, $this->getType()) > 0;
    }
}