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

namespace Thuata\IntercessionBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Thuata\IntercessionBundle\Intercession\IntercessionClass;
use Thuata\IntercessionBundle\Intercession\IntercessionMethod;
use Thuata\IntercessionBundle\Intercession\IntercessionVar;
use Thuata\IntercessionBundle\Service\GeneratorService;

/**
 * Class GeneratorServiceTest
 *
 * @package thuata\intercessionbundle\Tests\Service
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class GeneratorServiceTest extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testGeneratorServiceClassEmpty()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
}

EOL;

        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassNamespaced()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo.
 */
class Foo
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassDescription()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->setDescription('The marvelous Foo class !');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous Foo class !
 */
class Foo
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassDescriptionMultiline()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 */
class Foo
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassAuthor()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo.
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 */
class Foo
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMultipleAuthors()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo.
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMultipleAuthorsDescription()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassExtends()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->setExtends('\Bar\AbstractFooBar');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo extends \Bar\AbstractFooBar
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassImplementOne()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->addInterface('\Bar\FooBarInterface');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo
    implements \Bar\FooBarInterface
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassImplementsMultiple()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->addInterface('\Bar\FooBarInterface');
        $class->addInterface('\Bar\BarFooInterface');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo
    implements \Bar\FooBarInterface,
               \Bar\BarFooInterface
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassExtendsAndImplementsMultiple()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->addInterface('\Bar\FooBarInterface');
        $class->addInterface('\Bar\BarFooInterface');
        $class->setExtends('\Bar\AbstractFooBar');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo extends \Bar\AbstractFooBar
    implements \Bar\FooBarInterface,
               \Bar\BarFooInterface
{
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassTrait()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->addInterface('\Bar\FooBarInterface');
        $class->addInterface('\Bar\BarFooInterface');
        $class->addTrait('\Bar\FooBarTrait');
        $class->setExtends('\Bar\AbstractFooBar');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo extends \Bar\AbstractFooBar
    implements \Bar\FooBarInterface,
               \Bar\BarFooInterface
{
    use \Bar\FooBarTrait;
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMultipleTraits()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->addInterface('\Bar\FooBarInterface');
        $class->addInterface('\Bar\BarFooInterface');
        $class->addTrait('\Bar\FooBarTrait');
        $class->addTrait('\Bar\BarFooTrait');
        $class->setExtends('\Bar\AbstractFooBar');

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo extends \Bar\AbstractFooBar
    implements \Bar\FooBarInterface,
               \Bar\BarFooInterface
{
    use \Bar\FooBarTrait,
        \Bar\BarFooTrait;
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMethod()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $method = new IntercessionMethod();
        $method->setName('getBar');

        $class->addMethod($method);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    public function getBar()
    {
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMethodBody()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $method = new IntercessionMethod();
        $method->setName('getBar');
        $body = <<<EOF
\$var = 3;

if (\$var > 0) {
    return true;
}

return false;
EOF;

        $method->setBody($body);

        $class->addMethod($method);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    public function getBar()
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMethodBodyMultiple()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $methodBar = new IntercessionMethod();
        $methodBar->setName('getBar');
        $body = <<<EOF
\$var = 3;

if (\$var > 0) {
    return true;
}

return false;
EOF;

        $methodBar->setBody($body);
        $class->addMethod($methodBar);

        $methodBaz = new IntercessionMethod();
        $methodBaz->setName('getBaz');
        $methodBaz->setBody($body);
        $class->addMethod($methodBaz);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    public function getBar()
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }

    public function getBaz()
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMethodBodyMultipleDefinition()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $methodBar = new IntercessionMethod();
        $methodBar->setName('getBar');
        $body = <<<EOF
\$var = 3;

if (\$var > 0) {
    return true;
}

return false;
EOF;

        $methodBar->setBody($body);
        $methodBar->setDescription('Wonderfull Baz method');
        $methodBar->setTypeReturned('boolean');
        $methodBar->setVisibility(IntercessionMethod::VISIBILITY_PRIVATE);
        $class->addMethod($methodBar);

        $bazDescription = <<<EOL
Wonderfull
Incredible
Amazing
Baz Method
EOL;
        $methodBaz = new IntercessionMethod();
        $methodBaz->setName('getBaz');
        $methodBaz->setBody($body);
        $methodBaz->setDescription($bazDescription);
        $class->addMethod($methodBaz);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    /**
     * Wonderfull Baz method
     *
     * @return boolean
     */
    private function getBar()
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }

    /**
     * Wonderfull
     * Incredible
     * Amazing
     * Baz Method
     */
    public function getBaz()
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMethodParams()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $methodBar = new IntercessionMethod();
        $methodBar->setName('getBar');
        $body = <<<EOF
\$var = 3;

if (\$var > 0) {
    return true;
}

return false;
EOF;

        $methodBar->setBody($body);
        $methodBar->setDescription('Wonderfull Baz method');
        $methodBar->setTypeReturned('boolean');
        $methodBar->setVisibility(IntercessionMethod::VISIBILITY_PRIVATE);
        $class->addMethod($methodBar);

        $bazDescription = <<<EOL
Wonderfull
Incredible
Amazing
Baz Method
EOL;
        $methodBaz = new IntercessionMethod();
        $methodBaz->setName('getBaz');
        $methodBaz->setBody($body);
        $methodBaz->setDescription($bazDescription);
        $bazParam = new IntercessionVar();
        $bazParam->setName('baz');
        $bazParam->setType('string');
        $methodBaz->addParameter($bazParam);
        $class->addMethod($methodBaz);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    /**
     * Wonderfull Baz method
     *
     * @return boolean
     */
    private function getBar()
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }

    /**
     * Wonderfull
     * Incredible
     * Amazing
     * Baz Method
     *
     * @param string \$baz
     */
    public function getBaz(\$baz)
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMethodParamsClass()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $methodBar = new IntercessionMethod();
        $methodBar->setName('getBar');
        $body = <<<EOF
\$var = 3;

if (\$var > 0) {
    return true;
}

return false;
EOF;

        $methodBar->setBody($body);
        $methodBar->setDescription('Wonderfull Baz method');
        $methodBar->setTypeReturned('boolean');
        $methodBar->setVisibility(IntercessionMethod::VISIBILITY_PRIVATE);
        $barFirstParam = new IntercessionVar();
        $barFirstParam->setName('barFirst');
        $barFirstParam->setType('integer');
        $barSecondParam = new IntercessionVar();
        $barSecondParam->setName('barSecond');
        $barSecondParam->setType('\\Bar');
        $barSecondParam->setInitilisation('null');
        $methodBar->addParameter($barFirstParam);
        $methodBar->addParameter($barSecondParam);
        $class->addMethod($methodBar);

        $bazDescription = <<<EOL
Wonderfull
Incredible
Amazing
Baz Method
EOL;
        $methodBaz = new IntercessionMethod();
        $methodBaz->setName('getBaz');
        $methodBaz->setBody($body);
        $methodBaz->setDescription($bazDescription);
        $bazParam = new IntercessionVar();
        $bazParam->setName('baz');
        $bazParam->setType('string');
        $methodBaz->addParameter($bazParam);
        $class->addMethod($methodBaz);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    /**
     * Wonderfull Baz method
     *
     * @param integer \$barFirst
     * @param \\Bar \$barSecond
     *
     * @return boolean
     */
    private function getBar(\$barFirst, \\Bar \$barSecond = null)
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }

    /**
     * Wonderfull
     * Incredible
     * Amazing
     * Baz Method
     *
     * @param string \$baz
     */
    public function getBaz(\$baz)
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassProperty()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $property = new IntercessionVar\IntercessionProperty();
        $property->setName('bar');

        $class->addProperty($property);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    /**
     * @var mixed \$bar
     */
    public \$bar;
}

EOL;

        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassPropertyType()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $property = new IntercessionVar\IntercessionProperty();
        $property->setName('bar');
        $property->setType('\\FooBar');

        $class->addProperty($property);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    /**
     * @var \\FooBar \$bar
     */
    public \$bar;
}

EOL;

        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassPropertyMultiple()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');

        $barProperty = new IntercessionVar\IntercessionProperty();
        $barProperty->setName('bar');
        $barProperty->setType('\\FooBar');

        $bazProperty = new IntercessionVar\IntercessionProperty();
        $bazProperty->setName('baz');
        $bazProperty->setType('\\FooBaz');

        $class->addProperty($barProperty);
        $class->addProperty($bazProperty);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

/**
 * Class Foo.
 */
class Foo
{
    /**
     * @var \\FooBar \$bar
     */
    public \$bar;

    /**
     * @var \\FooBaz \$baz
     */
    public \$baz;
}

EOL;

        $this->assertEquals($expected, $generator->renderClass($class));
    }

    public function testGeneratorServiceClassMultipleFull()
    {
        $class = new IntercessionClass();

        $class->setName('Foo');
        $class->setNamespace('Bar/Baz');
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com');
        $class->addAuthor('Gabin Maudry', 'gabin.maudry@thuata.com');
        $description = <<<EOL
The marvelous
wonderfull
unbelievable
Foo class !
EOL;
        $class->setDescription($description);
        $class->addInterface('\Bar\FooBarInterface');
        $class->addInterface('\Bar\BarFooInterface');
        $class->addTrait('\Bar\FooBarTrait');
        $class->addTrait('\Bar\BarFooTrait');
        $class->setExtends('\Bar\AbstractFooBar');

        $methodBar = new IntercessionMethod();
        $methodBar->setName('getBar');
        $body = <<<EOF
\$var = 3;

if (\$var > 0) {
    return true;
}

return false;
EOF;

        $methodBar->setBody($body);
        $methodBar->setDescription('Wonderfull Baz method');
        $methodBar->setTypeReturned('boolean');
        $methodBar->setVisibility(IntercessionMethod::VISIBILITY_PRIVATE);
        $barFirstParam = new IntercessionVar();
        $barFirstParam->setName('barFirst');
        $barFirstParam->setType('integer');
        $barSecondParam = new IntercessionVar();
        $barSecondParam->setName('barSecond');
        $barSecondParam->setType('\\Bar');
        $barSecondParam->setInitilisation('null');
        $methodBar->addParameter($barFirstParam);
        $methodBar->addParameter($barSecondParam);
        $class->addMethod($methodBar);

        $bazDescription = <<<EOL
Wonderfull
Incredible
Amazing
Baz Method
EOL;
        $methodBaz = new IntercessionMethod();
        $methodBaz->setName('getBaz');
        $methodBaz->setBody($body);
        $methodBaz->setDescription($bazDescription);
        $bazParam = new IntercessionVar();
        $bazParam->setName('baz');
        $bazParam->setType('string');
        $methodBaz->addParameter($bazParam);
        $class->addMethod($methodBaz);

        $barProperty = new IntercessionVar\IntercessionProperty();
        $barProperty->setName('bar');
        $barProperty->setType('\\FooBar');
        $barProperty->setInitilisation('null');

        $bazProperty = new IntercessionVar\IntercessionProperty();
        $bazProperty->setName('baz');
        $bazProperty->setType('\\FooBaz');
        $bazProperty->setInitilisation('null');

        $class->addProperty($barProperty);
        $class->addProperty($bazProperty);

        /** @var GeneratorService $generator */
        $generator = $this->container->get('thuata_intercession.generator');

        $expected = <<<EOL
<?php
/*
    Created by the Thuata's Intercession bundle.
    see https://github.com/Thuata/IntercessionBundle
*/

namespace Bar/Baz;

/**
 * Class Foo. The marvelous
 * wonderfull
 * unbelievable
 * Foo class !
 *
 * @author Anthony Maudry <anthony.maudry@thuata.com>
 * @author Gabin Maudry <gabin.maudry@thuata.com>
 */
class Foo extends \Bar\AbstractFooBar
    implements \Bar\FooBarInterface,
               \Bar\BarFooInterface
{
    use \Bar\FooBarTrait,
        \Bar\BarFooTrait;

    /**
     * @var \\FooBar \$bar
     */
    public \$bar = null;

    /**
     * @var \\FooBaz \$baz
     */
    public \$baz = null;

    /**
     * Wonderfull Baz method
     *
     * @param integer \$barFirst
     * @param \\Bar \$barSecond
     *
     * @return boolean
     */
    private function getBar(\$barFirst, \\Bar \$barSecond = null)
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }

    /**
     * Wonderfull
     * Incredible
     * Amazing
     * Baz Method
     *
     * @param string \$baz
     */
    public function getBaz(\$baz)
    {
        \$var = 3;
        
        if (\$var > 0) {
            return true;
        }
        
        return false;
    }
}

EOL;


        $this->assertEquals($expected, $generator->renderClass($class));
    }
}