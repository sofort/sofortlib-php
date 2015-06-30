<?php
namespace Sofort\SofortLib;

abstract class AbstractClassTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\OverrideInYourImplementation';
    
    /**
     * @param array $params construct Params
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getTestClass(array $params = array())
    {
        return $this->getMockForAbstractClass($this->_classToTest, $params);
    }
}