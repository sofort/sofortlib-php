<?php

namespace Sofort\SofortLib\Xml\Element;
    
    /**
     * Sofort Text Element
     *
     * @author SOFORT GmbH (integration@sofort.com)
     *
     * @copyright 2010-2015 SOFORT GmbH
     *
     * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
     * @license http://www.gnu.org/licenses/lgpl.html
     *
     * @version SofortLib 2.1.2
     *
     * @link http://www.sofort.com/ official website
     */

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 *
 * Implementation of simple text
 */
class Text extends Element
{
    
    public $text;
    
    public $escape = false;
    
    
    /**
     * Constructor for SofortText
     *
     * @param string $text
     * @param bool $escape (default false)
     * @param bool $trim (default true)
     */
    public function __construct($text, $escape = false, $trim = true)
    {
        $this->text = $trim ? trim($text) : $text;
        $this->escape = $escape;
    }
    
    
    /**
     * Renders the element (override)
     *
     * @see SofortElement::render()
     * @return string
     */
    public function render()
    {
        return $this->escape ? htmlspecialchars($this->text) : $this->text;
    }
}