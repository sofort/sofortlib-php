<?php

namespace Sofort\SofortLib;

class PaycodeTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\Paycode';
    
    public function testCreatePaycode()
    {
        $validate_only = self::_getProperty('_validateOnly', $this->_classToTest);
        $SofortLibPaycode = new Paycode(self::$configkey);
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler',
            array(),
            '',
            false,
            true,
            true,
            array('handle', 'getRequest', 'getRawResponse'));
        
        $validate_only->setValue($SofortLibPaycode, true);
        $SofortLibPaycode->setDataHandler($AbstractDataHandler);
        $SofortLibPaycode->createPaycode();
    }
    
    
    public function testGetPaycode()
    {
        $SofortLibPaycode = new Paycode(self::$configkey);
        $this->assertFalse($SofortLibPaycode->getPaycode());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $paycode = '4711';
        $test['new_paycode']['paycode']['@data'] = $paycode;
        $response->setValue($SofortLibPaycode, $test);
        $this->assertEquals($paycode, $SofortLibPaycode->getPaycode());
    }
    
    
    public function testGetPaycodeUrl()
    {
        $SofortLibPaycode = new Paycode(self::$configkey);
        $this->assertFalse($SofortLibPaycode->getPaycodeUrl());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $paycode = 'http://www.google.de/4711';
        $test['new_paycode']['paycode_url']['@data'] = $paycode;
        $response->setValue($SofortLibPaycode, $test);
        $this->assertEquals($paycode, $SofortLibPaycode->getPaycodeUrl());
    }
    
    
    public function testSetEndDate()
    {
        $SofortLibPaycode = new Paycode(self::$configkey);
        $date = '2013-07-11 14:37:00';
        $this->assertEquals($SofortLibPaycode->setEndDate($date), $SofortLibPaycode);
        
        $received = $SofortLibPaycode->getParameters();
        $this->assertEquals($date, $received['end_date']);
    }
    
    
    public function testSofortLibPaycode()
    {
        $SofortLibPaycode = new Paycode(self::$configkey);
        $this->assertAttributeEquals('paycode', '_rootTag', $SofortLibPaycode);
    }
}
