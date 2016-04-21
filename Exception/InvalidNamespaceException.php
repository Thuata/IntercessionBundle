<?php
/**
 * Created by Enjoy Your Business.
 * Date: 21/04/2016
 * Time: 12:05
 * Copyright 2014 Enjoy Your Business - RCS Bourges B 800 159 295 ©
 */

namespace Thuata\IntercessionBundle\Exception;

/**
 * Class InvalidNamespaceException
 *
 * @package   Thuata\IntercessionBundle\Exception
 *
 * @author    Emmanuel Derrien <emmanuel.derrien@enjoyyourbusiness.fr>
 * @author    Anthony Maudry <anthony.maudry@enjoyyourbusiness.fr>
 * @author    Loic Broc <loic.broc@enjoyyourbusiness.fr>
 * @author    Rémy Mantéi <remy.mantei@enjoyyourbusiness.fr>
 * @author    Lucien Bruneau <lucien.bruneau@enjoyyourbusiness.fr>
 */
class InvalidNamespaceException extends \Exception
{
    const MESSAGE_FORMAT = 'Class or namespace "%s" is not well formated';
    const CODE = 500;

    /**
     * InvalidNamespaceException constructor.
     *
     * @param string $use
     */
    public function __construct($use)
    {
        parent::__construct(sprintf(self::MESSAGE_FORMAT, $use), self::CODE, null);
    }
}