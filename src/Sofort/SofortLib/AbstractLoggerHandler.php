<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Abstract Logger Handler
 */
abstract class AbstractLoggerHandler
{
    
    public function __construct()
    {
    }
    
    
    abstract function log($message, $log = 'log');
}