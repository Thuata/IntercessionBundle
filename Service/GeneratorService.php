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

namespace Thuata\IntercessionBundle\Service;

use Thuata\IntercessionBundle\Exception\NotFileException;
use Thuata\IntercessionBundle\Exception\NotWritableException;
use Thuata\IntercessionBundle\Intercession\IntercessionClass;

/**
 * Class GeneratorService
 *
 * @package thuata\intercessionbundle\Service
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class GeneratorService
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * GeneratorService constructor.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Renders a class definition and returns as string
     *
     * @param IntercessionClass $class
     *
     * @return string
     */
    public function renderClass(IntercessionClass $class)
    {
        return $this->twig->render('ThuataIntercessionBundle:Templates:IntercessionClass.php.twig', [
            'class' => $class
        ]);
    }

    /**
     * Writes the definition of a class in a file
     *
     * @param IntercessionClass $class
     * @param $file
     *
     * @throws \Exception
     */
    public function createClassDefinitionFile(IntercessionClass $class, $file)
    {
        if (!is_file($file)) {
            throw new NotFileException($file);
        }
        if (!is_writable($file)) {
            throw new NotWritableException($file);
        }

        file_put_contents($file, $this->renderClass($class));
    }
}