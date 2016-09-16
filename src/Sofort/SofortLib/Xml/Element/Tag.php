<?php

namespace Sofort\SofortLib\Xml\Element;

use Sofort\SofortLib\Xml\XmlToArrayNode;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Implementation of a simple tag
 *
 */
class Tag extends Element
{
    
    public $tagname = '';
    
    public $attributes = array();
    
    public $children = array();
    
    
    /**
     * Constructor for SofortTag
     *
     * @param string $tagname
     * @param array $attributes (optional)
     * @param array $children (optional)
     */
    public function __construct($tagname, array $attributes = array(), $children = array())
    {
        $this->tagname = $tagname;
        $this->attributes = $attributes;
        $this->children = is_array($children) ? $children : array($children);
    }
    
    
    /**
     * Renders the element (override)
     *
     * @see SofortElement::render()
     * @return string
     */
    public function render()
    {
        $output = '';
        $attributes = '';
        
        /** @var XmlToArrayNode $child */
        foreach ($this->children as $child) {
            $output .= is_object($child) ? $child->render(false) : $child;
        }
        
        foreach ($this->attributes as $key => $value) {
            $attributes .= " $key=\"$value\"";
        }
        
        return $this->_render($output, $attributes);
    }
    
    
    /**
     * Render the output
     *
     * @param string $output
     * @param string $attributes
     * @return string
     */
    protected function _render($output, $attributes)
    {
        return $output !== ''
            ? "<{$this->tagname}{$attributes}>{$output}</{$this->tagname}>"
            : "<{$this->tagname}{$attributes} />";
    }
}