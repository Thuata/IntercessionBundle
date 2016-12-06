<?php
/**
 * Created by Enjoy Your Business.
 * Date: 05/12/2016
 * Time: 14:24
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\IntercessionBundle\Exception;


/**
 * Class InvalidTypeForDeclaredTypeReturned
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
class InvalidTypeForDeclaredTypeReturned extends \LogicException
{
    const MESSAGE_FORMAT = 'The type "%s" is not a valid return type for declared return type. See http://php.net/manual/fr/functions.returning-values.php#functions.returning-values.type-declaration';
    const ERROR_CODE = 500;

    /**
     * InvalidTypeForDeclaredTypeReturned constructor.
     *
     * @param string $typeName
     */
    public function __construct(string $typeName)
    {
        parent::__construct(sprintf(self::MESSAGE_FORMAT, $typeName), self::ERROR_CODE);
    }
}