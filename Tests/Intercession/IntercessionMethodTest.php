<?php
/**
 * Created by Enjoy Your Business.
 * Date: 05/12/2016
 * Time: 14:08
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\IntercessionBundle\Tests\Intercession;
use Thuata\IntercessionBundle\Intercession\IntercessionMethod;


/**
 * Class IntercessionMethodTest
 *
 * @package   Thuata\IntercessionBundle\Tests\Intercession
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 * @author    Matthieu Prieur <matthieu.prieur@enjoyyourbusiness.fr>
 * @copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */
class IntercessionMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testStrongTypeReturned
     */
    public function testStrongTypeReturned()
    {
        $method = new IntercessionMethod();

        $method->setTypeReturned('string');

        $method->setStrongTypeReturned(true);

        $this->assertEquals('string', $method->isStrongTypeReturned());
    }
}