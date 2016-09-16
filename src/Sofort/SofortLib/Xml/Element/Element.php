<?php

namespace Sofort\SofortLib\Xml\Element;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Implementation of a simple element
 *
 */
abstract class Element
{
    
    /**
     * Render the element
     */
    public abstract function render();
}