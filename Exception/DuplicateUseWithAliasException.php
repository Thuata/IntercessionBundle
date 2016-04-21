<?php
/**
 * Created by Enjoy Your Business.
 * Date: 21/04/2016
 * Time: 12:21
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\IntercessionBundle\Exception;

/**
 * Class DuplicateUseWithAliasException
 *
 * @package   Thuata\IntercessionBundle\Exception
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 */
class DuplicateUseWithAliasException extends \Exception
{
    const MESSAGES_FORMAT = 'Trying to use class or namespace "%s" with alias "%s", but was already used with "%s"';
    const ERROR_CODE = 500;

    /**
     * DuplicateUseWithAliasException constructor.
     *
     * @param string $use
     * @param string $alias
     * @param string $found
     */
    public function __construct($use, $alias, $found)
    {
        parent::__construct(sprintf(self::MESSAGES_FORMAT, $use, $alias, $found), self::ERROR_CODE);
    }
}