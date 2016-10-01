<?php
/**
 * Created by Enjoy Your Business.
 * Date: 21/04/2016
 * Time: 14:16
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\IntercessionBundle\Exception;

/**
 * Class DuplicateUseFirstWithoutAliasException
 *
 * @package   Thuata\IntercessionBundle\Exception
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 */
class DuplicateUseFirstWithoutAliasException extends \Exception
{
    const MESSAGES_FORMAT = 'Trying to use class or namespace "%s" with alias "%s", but was already used without alias';
    const ERROR_CODE = 500;

    /**
     * DuplicateUseWithAliasException constructor.
     *
     * @param string $use
     * @param string $alias
     */
    public function __construct(string $use, string $alias)
    {
        parent::__construct(sprintf(self::MESSAGES_FORMAT, $use, $alias), self::ERROR_CODE);
    }
}