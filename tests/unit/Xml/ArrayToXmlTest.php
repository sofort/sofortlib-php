<?php

namespace Sofort\SofortLib;

use Sofort\SofortLib\Xml\ArrayToXml;
use Sofort\SofortLib\Xml\Element\Tag;
use Sofort\SofortLib\Xml\Element\Text;

class ArrayToXmlTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\Xml\ArrayToXml';
    
    public function testCheckDepth()
    {
        $this->setExpectedException('Sofort\SofortLib\Xml\ArrayToXmlException');
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $checkDepth = self::_getMethod('_checkDepth', $this->_classToTest);
        $checkDepth->invoke($ArrayToXml, array(11));
        
    }
    
    
    public function testConstruct()
    {
        $ArrayToXml = new ArrayToXml(array());
        $this->assertAttributeEquals('', '_parsedData', $ArrayToXml);
        
        $ArrayToXml = new ArrayToXml(array(), 5, false);
        $this->assertAttributeEquals(5, '_maxDepth', $ArrayToXml);
    }
    
    
    public function testConstructInputSizeException()
    {
        $this->setExpectedException('Sofort\SofortLib\Xml\ArrayToXmlException');
        new ArrayToXml(array(1, 2));
    }
    
    
    public function testConstructMaxDepthException()
    {
        $this->setExpectedException('Sofort\SofortLib\Xml\ArrayToXmlException');
        new ArrayToXml(array(1), 55);
    }
    
    
    public function testCreateNode()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $Tag = new Tag('node', array('attribute1' => 1), array());
        $createNode = self::_getMethod('_createNode', $this->_classToTest);
        $this->assertEquals($createNode->invoke($ArrayToXml, 'node', array('attribute1' => 1), array()), $Tag);
    }
    
    
    public function testCreateTextNode()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $Text = new Text('node', true, false);
        $createTextNode = self::_getMethod('_createTextNode', $this->_classToTest);
        $this->assertEquals($createTextNode->invoke($ArrayToXml, 'node', false), $Text);
    }
    
    
    public function testExtractAttributesSection()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $extractAttributesSection = self::_getMethod('_extractAttributesSection', $this->_classToTest);
        
        $node = array('@attributes' => 'test');
        $attributes = array('test');
        $this->assertEquals($extractAttributesSection->invokeArgs($ArrayToXml, array(&$node)), $attributes);
        
        $node = array('@attributes' => array('test'));
        $attributes = array('test');
        $this->assertEquals($extractAttributesSection->invokeArgs($ArrayToXml, array(&$node)), $attributes);
        
        $node = array('@attributes' => false);
        $attributes = array();
        $this->assertEquals($extractAttributesSection->invokeArgs($ArrayToXml, array(&$node)), $attributes);
    }
    
    
    public function testExtractDataSection()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $extractDataSection = self::_getMethod('_extractDataSection', $this->_classToTest);
        $Text = new Text('node', true, false);
        
        $node = array('@data' => 'node');
        $this->assertEquals($extractDataSection->invokeArgs($ArrayToXml, array(&$node, true)), array($Text));
        
        $node = array('@data' => false);
        $data = array();
        $this->assertEquals($extractDataSection->invokeArgs($ArrayToXml, array(&$node, true)), $data);
    }
    
    
    public function testPrivateRender()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $render = self::_getMethod('_render', $this->_classToTest);
        $Tag = new Tag('node', array('attribute1' => 1), array());
        $render->invoke($ArrayToXml, array('test'), $Tag, 5, true);
        $render->invoke($ArrayToXml, 'test', $Tag, 5, true);
    }
    
    
    public function testRender()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $this->assertEquals(
            "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<test>1</test>",
            $ArrayToXml->render(array('test' => 1))
        );
    }
    
    
    public function testToXml()
    {
        $ArrayToXml = new ArrayToXml(array(array(1)));
        $parsedData = self::_getProperty('_parsedData', $this->_classToTest);
        $test = 'Test';
        $parsedData->setValue($ArrayToXml, $test);
        $this->assertEquals($test, $ArrayToXml->toXml(false, false));
        $this->assertEquals("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\nTest", $ArrayToXml->toXml());
    }
}