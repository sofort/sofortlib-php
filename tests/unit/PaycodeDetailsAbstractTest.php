<?php

namespace Sofort\SofortLib;

/**
 * Class constructed just to test the methods of the abstract class
 * @author mm
 *
 */
class PaycodeDetailsAbstractMock extends PaycodeDetailsAbstract
{
}


class PaycodeDetailsAbstractTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\PaycodeDetailsAbstractMock';
    
    
    public function testExtractValue()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $extractValue = self::_getMethod('_extractValue', $this->_classToTest);
        $this->assertFalse($extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_2'));
        
        $data_structure = array(
            'tag_1' => array('@data' => 'simple tag'),
            'tag_2' => '',
            'parent_tag_1' => array('tag_3' => array('@data' => 'with parent tag')),
            'parent_tag_2' => array('tag_4' => ''),
            'parent_tag_3' => array('tag_5' => array(0 => array('@data' => 'parent tag and counter'))),
            'parent_tag_4' => array('tag_6' => array(1 => array('@data' => 'parent tag and count 1'))),
            'parent_tag_5' => array('tag_7' => array(0 => '')),
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals(
            'simple tag', $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_1')
        );
        $this->assertFalse(
            $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_2')
        );
        $this->assertEquals(
            'with parent tag', $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_3', 'parent_tag_1')
        );
        $this->assertFalse(
            $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_4', 'parent_tag_2')
        );
        $this->assertEquals(
            'parent tag and counter',
            $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_5', 'parent_tag_3', 0)
        );
        $this->assertEquals(
            'parent tag and count 1',
            $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_6', 'parent_tag_4', 1)
        );
        $this->assertFalse(
            $extractValue->invoke($SofortLibPaycodeDetailsAbstractMock, 'tag_7', 'parent_tag_5', 0)
        );
    }
    
    
    public function testGetAmount()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getAmount());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 12.45;
        $data_structure = array('amount' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getAmount());
    }
    
    
    public function testGetCurrencyCode()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getCurrencyCode());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 'EUR';
        $data_structure = array('currency_code' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getCurrencyCode());
    }
    
    
    public function testGetEndDate()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getEndDate());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '2013-05-05';
        $data_structure = array('end_date' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getEndDate());
    }
    
    
    public function testGetLanguageCode()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getLanguageCode());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 'DE';
        $data_structure = array('language_code' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getLanguageCode());
    }
    
    
    public function testGetProjectId()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getProjectId());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '4711';
        $data_structure = array('project_id' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getProjectId());
        
    }
    
    
    public function testGetReason()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getReason());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 'line number ';
        $data_structure = array(
            'reasons' => array(
                'reason' => array(
                    0 => array('@data' => $data_2_b_tested . '1'),
                    1 => array('@data' => $data_2_b_tested . '2')
                ),
            )
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested . '1', $SofortLibPaycodeDetailsAbstractMock->getReason());
        $this->assertEquals($data_2_b_tested . '1', $SofortLibPaycodeDetailsAbstractMock->getReason(0));
        $this->assertEquals($data_2_b_tested . '2', $SofortLibPaycodeDetailsAbstractMock->getReason(1));
    }
    
    
    public function testGetSenderBankCode()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getSenderBankCode());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '45454545';
        $data_structure = array(
            'sender' => array(
                'bank_code' => array('@data' => $data_2_b_tested),
            )
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getSenderBankCode());
    }
    
    
    public function testGetSenderBic()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getSenderBic());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '345459457945454';
        $data_structure = array(
            'sender' => array(
                'bic' => array('@data' => $data_2_b_tested),
            )
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getSenderBic());
    }
    
    
    public function testGetSenderCountryCode()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getSenderCountryCode());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 'DE';
        $data_structure = array(
            'sender' => array(
                'country_code' => array('@data' => $data_2_b_tested),
            )
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getSenderCountryCode());
    }
    
    
    public function testGetStartDate()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getStatus());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '2013-09-03';
        $data_structure = array('start_date' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getStartDate());
    }
    
    
    public function testGetStatus()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getStatus());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 'simple tag';
        $data_structure = array('status' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getStatus());
    }
    
    
    public function testGetTimeCreated()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getTimeCreated());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '2013-05-05';
        $data_structure = array('time_created' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getTimeCreated());
    }
    
    
    public function testGetTimeUsed()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getTimeUsed());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '2013-05-05';
        $data_structure = array('time_used' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getTimeUsed());
    }
    
    
    public function testGetTransaction()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getTransaction());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = '12345-00454-34343';
        $data_structure = array('transaction' => array('@data' => $data_2_b_tested));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested, $SofortLibPaycodeDetailsAbstractMock->getTransaction());
    }
    
    
    public function testGetUserVariable()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertFalse($SofortLibPaycodeDetailsAbstractMock->getUserVariable());
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $data_2_b_tested = 'user variable ';
        $data_structure = array(
            'user_variables' => array(
                'variable' => array(
                    0 => array('@data' => $data_2_b_tested . '1'),
                    1 => array('@data' => $data_2_b_tested . '2')
                ),
            )
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure);
        $this->assertEquals($data_2_b_tested . '1', $SofortLibPaycodeDetailsAbstractMock->getUserVariable());
        $this->assertEquals($data_2_b_tested . '1', $SofortLibPaycodeDetailsAbstractMock->getUserVariable(0));
        $this->assertEquals($data_2_b_tested . '2', $SofortLibPaycodeDetailsAbstractMock->getUserVariable(1));
        
        $data_structure_one_entry = array(
            'user_variables' => array(
                'variable' => array('@data' => $data_2_b_tested . '1'),
            )
        );
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $data_structure_one_entry);
        $this->assertEquals($data_2_b_tested . '1', $SofortLibPaycodeDetailsAbstractMock->getUserVariable());
    }
    
    
    public function testParse()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $root = self::_getProperty('_root', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $rootValue = $root->getValue($SofortLibPaycodeDetailsAbstractMock);
        $testArray = array('test_1', 'test_2');
        $responseUnparsed = array($rootValue . '_details' => array('test_1', 'test_2'));
        $response->setValue($SofortLibPaycodeDetailsAbstractMock, $responseUnparsed);
        $parse->invoke($SofortLibPaycodeDetailsAbstractMock);
        $this->assertAttributeEquals($testArray, '_response', $SofortLibPaycodeDetailsAbstractMock);
    }
    
    
    public function testSendRequest()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $validate_only = self::_getProperty('_validateOnly', $this->_classToTest);
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler',
            array(),
            '',
            false,
            true,
            true,
            array('handle', 'getRequest', 'getRawResponse'));
        
        $validate_only->setValue($SofortLibPaycodeDetailsAbstractMock, true);
        $SofortLibPaycodeDetailsAbstractMock->setDataHandler($AbstractDataHandler);
        $SofortLibPaycodeDetailsAbstractMock->sendRequest();
        $this->assertAttributeEquals('paycode_request', '_rootTag', $SofortLibPaycodeDetailsAbstractMock);
    }
    
    
    public function testSetRoot()
    {
        $SofortLibPaycodeDetailsAbstractMock = new PaycodeDetailsAbstractMock(self::$configkey);
        $this->assertAttributeEquals('paycode', '_root', $SofortLibPaycodeDetailsAbstractMock);
        
        $root = 'billcode';
        $setCode = self::_getMethod('_setRoot', $this->_classToTest);
        $setCode->invoke($SofortLibPaycodeDetailsAbstractMock, $root);
        $this->assertAttributeEquals($root, '_root', $SofortLibPaycodeDetailsAbstractMock);
    }
}