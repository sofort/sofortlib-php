<?php

namespace Sofort\SofortLib\Xml;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * XML To Array Node
 */
class XmlToArrayNode
{
    
    /**
     * Attributes
     *
     * @var array
     */
    private $_attributes = array();
    
    /**
     * Children
     *
     * @var array
     */
    private $_children = array();
    
    /**
     * Data
     *
     * @var string
     */
    private $_data = '';
    
    /**
     * Name
     *
     * @var string
     */
    private $_name = '';
    
    /**
     * Open
     *
     * @var bool
     */
    private $_open = true;
    
    /**
     * Parent XML to arrayNode
     * @var null
     */
    private $_ParentXmlToArrayNode = null;
    
    
    /**
     * Constructor for XmlToArrayNode
     *
     * @param string $name
     * @param array|bool $attributes
     */
    public function __construct($name, $attributes)
    {
        $this->_name = $name;
        $this->_attributes = $attributes;
    }
    
    
    /**
     * Add a child to collection
     *
     * @param XmlToArrayNode $XmlToArrayNode
     * @return void
     */
    public function addChild(XmlToArrayNode $XmlToArrayNode)
    {
        $this->_children[] = $XmlToArrayNode;
    }
    
    
    /**
     * Getter for data, returns an array
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }
    
    
    /**
     * Getter for name, returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
    
    
    /**
     * Getter for parent node
     *
     * @return XmlToArrayNode
     */
    public function getParentXmlToArrayNode()
    {
        return $this->_ParentXmlToArrayNode;
    }
    
    
    /**
     * Does it have any children
     *
     * @return int count of children
     */
    public function hasChildren()
    {
        return count($this->_children);
    }
    
    
    /**
     * Does it have a node
     *
     * @return bool
     */
    public function hasParentXmlToArrayNode()
    {
        return $this->_ParentXmlToArrayNode instanceof XmlToArrayNode;
    }
    
    
    /**
     * Is it open, returns _open
     *
     * @return bool
     */
    public function isOpen()
    {
        return $this->_open;
    }
    
    
    /**
     * Renders nodes as array
     *
     * @param bool $simpleStructure pass true to get an array without @data and @attributes fields
     * @return array
     */
    public function render($simpleStructure)
    {
        $array = array();
        $multiples = $this->_countChildren($this->_children);
        
        /** @var XmlToArrayNode $Child */
        foreach ($this->_children as $Child) {
            $simpleStructureChildHasNoChildren = $simpleStructure && !$Child->hasChildren();
            
            if ($multiples[$Child->getName()]) {
                $array[$Child->getName()][] = $this->_renderNode($Child, $simpleStructureChildHasNoChildren,
                    $simpleStructure);
            } else {
                $array[$Child->getName()] = $this->_renderNode($Child, $simpleStructureChildHasNoChildren,
                    $simpleStructure);
            }
        }
        
        if (!$simpleStructure) {
            $array['@data'] = $this->_data;
            $array['@attributes'] = $this->_attributes;
        }
        
        return $this->_ParentXmlToArrayNode instanceof XmlToArrayNode
            ? $array
            : array($this->_name => $simpleStructure && !$this->hasChildren() ? $this->getData() : $array);
    }
    
    
    /**
     * Set it to closed
     *
     * @return void
     */
    public function setClosed()
    {
        $this->_open = false;
    }
    
    
    /**
     * Setter for variable data
     *
     * @param string $data
     * @return void
     */
    public function setData($data)
    {
        $this->_data .= $data;
    }
    
    
    /**
     * Setter for parent node
     *
     * @param XmlToArrayNode $XmlToArrayNode
     * @return void
     */
    public function setParentXmlToArrayNode(XmlToArrayNode $XmlToArrayNode)
    {
        $this->_ParentXmlToArrayNode = $XmlToArrayNode;
    }
    
    
    /**
     * Counts the children of an array and returns them in an associative array
     *
     * @param array $Children
     * @return array
     */
    private function _countChildren($Children)
    {
        $multiples = array();
        
        /** @var XmlToArrayNode $Child */
        foreach ($Children as $Child) {
            $multiples[$Child->getName()] = isset($multiples[$Child->getName()])
                ? $multiples[$Child->getName()] + 1
                : 0;
        }
        
        return $multiples;
    }
    
    
    /**
     * Renders a single node
     *
     * @param XmlToArrayNode $Child
     * @param bool $simpleStructureChildHasNoChildren
     * @param bool $simpleStructure
     * @return array
     */
    private function _renderNode($Child, $simpleStructureChildHasNoChildren, $simpleStructure)
    {
        if ($simpleStructureChildHasNoChildren) {
            return $Child->getData();
        }
        
        return $Child->render($simpleStructure);
    }
}