<?php

namespace Sofort\SofortLib;

/**
 * Class constructed just to test the methods of the abstract class
 * @author mm
 *
 */
class PaycodeAbstractMock extends PaycodeAbstract
{
}

class PaycodeAbstractTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\PaycodeAbstractMock';
    
    public function testGetCode()
    {
        $SofortLibPaycodeAbstractMock = new PaycodeAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeAbstractMock->getCode());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $code = '4711';
        $test['new_paycode']['paycode']['@data'] = $code;
        $response->setValue($SofortLibPaycodeAbstractMock, $test);
        $this->assertEquals($code, $SofortLibPaycodeAbstractMock->getCode());
    }
    
    
    public function testGetCodeUrl()
    {
        $SofortLibPaycodeAbstractMock = new PaycodeAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeAbstractMock->getCodeUrl());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $code = 'http://www.google.de/4711';
        $test['new_paycode']['paycode_url']['@data'] = $code;
        $response->setValue($SofortLibPaycodeAbstractMock, $test);
        $this->assertEquals($code, $SofortLibPaycodeAbstractMock->getCodeUrl());
    }
    
    
    public function testSetEndDate()
    {
        $SofortLibPaycodeAbstractMock = new PaycodeAbstractMock(self::$configkey);
        
        $date = '2013-07-11 14:37:00';
        $this->assertEquals($SofortLibPaycodeAbstractMock->setEndDate($date), $SofortLibPaycodeAbstractMock);
        
        $received = $SofortLibPaycodeAbstractMock->getParameters();
        $this->assertEquals($date, $received['end_date']);
    }
    
    
    public function testSetSenderBankCode()
    {
        $SofortLibPaycodeAbstractMock = new PaycodeAbstractMock(self::$configkey);
        
        $bankCode = '12345678';
        $this->assertEquals($SofortLibPaycodeAbstractMock->setSenderBankCode($bankCode), $SofortLibPaycodeAbstractMock);
        
        $received = $SofortLibPaycodeAbstractMock->getParameters();
        $this->assertEquals($bankCode, $received['sender']['bank_code']);
    }
    
    
    public function testSetStartDate()
    {
        $SofortLibPaycodeAbstractMock = new PaycodeAbstractMock(self::$configkey);
        
        $date = '2013-07-11 14:37:00';
        $this->assertEquals($SofortLibPaycodeAbstractMock->setStartDate($date), $SofortLibPaycodeAbstractMock);
        
        $received = $SofortLibPaycodeAbstractMock->getParameters();
        $this->assertEquals($date, $received['start_date']);
    }
    
    
    public function testSofortLibPaycode()
    {
        $SofortLibPaycodeAbstractMock = new PaycodeAbstractMock(self::$configkey);
        $this->assertAttributeEquals('paycode', '_rootTag', $SofortLibPaycodeAbstractMock);
    }
}
