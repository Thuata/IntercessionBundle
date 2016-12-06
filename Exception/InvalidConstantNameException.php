<?php
/**
 * Created by Enjoy Your Business.
 * Date: 05/12/2016
 * Time: 13:55
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\IntercessionBundle\Exception;


/**
 * Class InvalidConstantNameException
 *
 * @package   Thuata\IntercessionBundle\Exception
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 * @author    Matthieu Prieur <matthieu.prieur@enjoyyourbusiness.fr>
 * @copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */
class InvalidConstantNameException extends \LogicException
{
    const MESSAGE_FORMAT = 'The constant name \'%s\' is invalid. A constant name should start with a letter or underscore (\'_\') and be followed by letters, underscores and digits';
    const ERROR_CODE = 500;

    /**
     * InvalidConstantNameException constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf(self::MESSAGE_FORMAT, $name), self::ERROR_CODE);
    }
}