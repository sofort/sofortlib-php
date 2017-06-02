<?php

namespace Sofort\SofortLib\Logger;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Abstract Logger Handler
 */
abstract class AbstractLoggerHandler
{
    
    abstract function log($message, $log = 'log');
}