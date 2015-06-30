<?php

namespace Sofort\SofortLib;

class RefundTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\Refund';
    
    protected $_xmlResponse = array(
        'refunds' => array(
            'sender' => array(
                'holder' => array(
                    '@data' => 'Max Mustermann',
                    '@attributes' => array(),
                ),
                'iban' => array(
                    '@data' => 'DE471108151234567890',
                    '@attributes' => array(),
                ),
                'bic' => array(
                    '@data' => 'DEKTDE71002',
                    '@attributes' => array(),
                ),
            ),
            'title' => array(
                '@data' => 'Multipay API-Rückbuchung vom YYYY-MM-DD',
                '@attributes' => array(),
            ),
            'refund' => array(
                0 => array(
                    'recipient' => array(
                        'holder' => array(
                            '@data' => 'Moritz Mustermann',
                            '@attributes' => array(),
                        ),
                        'bank_name' => array(
                            '@data' => 'Die Bank',
                            '@attributes' => array(),
                        ),
                        'iban' => array(
                            '@data' => 'DE471108151234567890',
                            '@attributes' => array(),
                        ),
                        'bic' => array(
                            '@data' => 'DEKTDE71002',
                            '@attributes' => array(),
                        ),
                    ),
                    'transaction' => array(
                        '@data' => '00000-00000-00000000-0000',
                        '@attributes' => array(),
                    ),
                    'amount' => array(
                        '@data' => 0.50,
                        '@attributes' => array(),
                    ),
                    'comment' => array(
                        '@data' => 'partial refund',
                        '@attributes' => array(),
                    ),
                    'partial_refund_id' => array(
                        '@data' => 'refid1234567890',
                        '@attributes' => array(),
                    ),
                    'time' => array(
                        '@data' => '00-00-0000',
                        '@attributes' => array(),
                    ),
                    'status' => array(
                        '@data' => 'ok',
                        '@attributes' => array(),
                    ),
                    'reason_1' => array(
                        '@data' => 'reason_1',
                        '@attributes' => array(),
                    ),
                    'reason_2' => array(
                        '@data' => 'reason_2',
                        '@attributes' => array(),
                    ),
                ),
            ),
            'dta' => array(
                '@data' => 'Inhalt fuer DTA-Datei',
                '@attributes' => array(),
            ),
            'pain' => array(
                '@data' => 'Inhalt fuer Pain',
                '@attributes' => array(),
            ),
        ),
    );
    
    protected $_xmlResponseError = array(
        'refunds' => array(
            'sender' => array(
                'holder' => array(
                    '@data' => 'Max Mustermann',
                    '@attributes' => array(),
                ),
                'account_number' => array(
                    '@data' => '9999999999',
                    '@attributes' => array(),
                ),
                'bank_code' => array(
                    '@data' => '88888888',
                    '@attributes' => array(),
                ),
            ),
            'title' => array(
                '@data' => 'Multipay API-Rückbuchung vom YYYY-MM-DD',
                '@attributes' => array(),
            ),
            'refund' => array(
                0 => array(
                    'transaction' => array(
                        '@data' => '00000-00000-00000000-0000',
                        '@attributes' => array(),
                    ),
                    'amount' => array(
                        '@data' => 0.50,
                        '@attributes' => array(),
                    ),
                    'comment' => array(
                        '@data' => 'partial refund',
                        '@attributes' => array(),
                    ),
                    'partial_refund_id' => array(
                        '@data' => '',
                        '@attributes' => array(),
                    ),
                    'status' => array(
                        '@data' => 'error',
                        '@attributes' => array(),
                    ),
                    'errors' => array(
                        'error' => array(
                            0 => array(
                                'code' => array(
                                    '@data' => 5002,
                                    '@attributes' => array(),
                                ),
                                'message' => array(
                                    '@data' => 'Transaction not found',
                                    '@attributes' => array(),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );
    
    protected $_xmlResponseErrorFlat = array(
        'refunds' => array(
            'sender' => array(
                'holder' => array(
                    '@data' => 'Max Mustermann',
                    '@attributes' => array(),
                ),
                'account_number' => array(
                    '@data' => '9999999999',
                    '@attributes' => array(),
                ),
                'bank_code' => array(
                    '@data' => '88888888',
                    '@attributes' => array(),
                ),
            ),
            'title' => array(
                '@data' => 'Multipay API-Rückbuchung vom YYYY-MM-DD',
                '@attributes' => array(),
            ),
            'refund' => array(
                'transaction' => array(
                    '@data' => '00000-00000-00000000-0000',
                    '@attributes' => array(),
                ),
                'amount' => array(
                    '@data' => 0.50,
                    '@attributes' => array(),
                ),
                'comment' => array(
                    '@data' => 'partial refund',
                    '@attributes' => array(),
                ),
                'partial_refund_id' => array(
                    '@data' => '',
                    '@attributes' => array(),
                ),
                'status' => array(
                    '@data' => 'error',
                    '@attributes' => array(),
                ),
                'errors' => array(
                    'error' => array(
                        'code' => array(
                            '@data' => 5002,
                            '@attributes' => array(),
                        ),
                        'message' => array(
                            '@data' => 'Transaction not found',
                            '@attributes' => array(),
                        ),
                    ),
                ),
            ),
        ),
    );
    
    private $_handledErrors = array(
        'global' => array(
            0 => array(
                'code' => 5002,
                'message' => 'Transaction not found',
                'field' => '',
            ),
        ),
    );
    
    public function providerAddRefund()
    {
        return array(array(array('00907-01222-50D43927-FFDF', 1, '17:43 auf gehts')));
    }
    
    
    public function providerSetPartialRefundId()
    {
        return array(array(array('00907-01222-50D43927-FFDF', 1, '17:43 auf gehts', 'refId4711')));
    }
    
    
    public function providerSetReason()
    {
        return array(array(array('00907-01222-50D43927-FFDF', 1, '17:43 auf gehts', 'reason_1', 'reason_2')));
    }
    
    
    public function providerSetTitle()
    {
        return array(array('Multipay API-Rückbuchung vom YYYY-MM-DD'));
    }
    
    
    /**
     * @dataProvider providerAddRefund
     * @param $provided
     */
    public function testAddRefund($provided)
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $SofortLibRefund->addRefund($provided[0], $provided[1], $provided[2]);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals($provided, array(
            $received['refund'][0]['transaction'],
            $received['refund'][0]['amount'],
            $received['refund'][0]['comment']
        ));
        
        $SofortLibRefund->addRefund($provided[0], $provided[1], $provided[2]);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals($provided, array(
            $received['refund'][1]['transaction'],
            $received['refund'][1]['amount'],
            $received['refund'][1]['comment']
        ));
    }
    
    
    public function testGetAmount()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals(0.50, $SofortLibRefund->getAmount());
        $this->assertEquals(0.50, $SofortLibRefund->getAmount(0));
        $this->assertFalse($SofortLibRefund->getAmount(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getAmount());
    }
    
    
    public function testGetComment()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('partial refund', $SofortLibRefund->getComment());
        $this->assertEquals('partial refund', $SofortLibRefund->getComment(0));
        $this->assertFalse($SofortLibRefund->getComment(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getComment());
    }
    
    
    public function testGetDta()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('Inhalt fuer DTA-Datei', $SofortLibRefund->getDta());
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getDta());
    }
    
    
    public function testGetPain()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('Inhalt fuer Pain', $SofortLibRefund->getPain());
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getPain());
    }
    
    
    public function testGetPartialRefundId()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('refid1234567890', $SofortLibRefund->getPartialRefundId());
        $this->assertEquals('refid1234567890', $SofortLibRefund->getPartialRefundId(0));
        $this->assertFalse($SofortLibRefund->getPartialRefundId(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getPartialRefundId());
    }
    
    
    public function testGetReason()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('reason_1', $SofortLibRefund->getReason(0));
        $this->assertEquals('reason_1', $SofortLibRefund->getReason(0, 'reason_1'));
        $this->assertEquals('reason_2', $SofortLibRefund->getReason(0, 'reason_2'));
        $this->assertFalse($SofortLibRefund->getReason(0, 'test'));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getPain());
    }
    
    
    public function testGetRecipientBankName()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('Die Bank', $SofortLibRefund->getRecipientBankName());
        $this->assertEquals('Die Bank', $SofortLibRefund->getRecipientBankName(0));
        $this->assertFalse($SofortLibRefund->getRecipientBankName(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getRecipientBankName());
    }
    
    
    public function testGetRecipientBic()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('DEKTDE71002', $SofortLibRefund->getRecipientBic());
        $this->assertEquals('DEKTDE71002', $SofortLibRefund->getRecipientBic(0));
        $this->assertFalse($SofortLibRefund->getRecipientBic(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getRecipientBic());
    }
    
    
    public function testGetRecipientHolder()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('Moritz Mustermann', $SofortLibRefund->getRecipientHolder());
        $this->assertEquals('Moritz Mustermann', $SofortLibRefund->getRecipientHolder(0));
        $this->assertFalse($SofortLibRefund->getRecipientHolder(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getRecipientHolder());
    }
    
    
    public function testGetRecipientIban()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('DE471108151234567890', $SofortLibRefund->getRecipientIban());
        $this->assertEquals('DE471108151234567890', $SofortLibRefund->getRecipientIban(0));
        $this->assertFalse($SofortLibRefund->getRecipientIban(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getRecipientIban());
    }
    
    
    public function testGetRefundError()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertFalse($SofortLibRefund->getRefundError());
        $this->assertFalse($SofortLibRefund->getRefundError(0));
        $this->assertFalse($SofortLibRefund->getRefundError(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getRefundError());
        
        $response->setValue($SofortLibRefund, $this->_xmlResponseError);
        $this->assertEquals('Error: 5002:Transaction not found', $SofortLibRefund->getRefundError());
        $this->assertEquals('Error: 5002:Transaction not found', $SofortLibRefund->getRefundError(0));
        $this->assertFalse($SofortLibRefund->getRefundError(1));
    }
    
    
    public function testGetSenderBic()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('DEKTDE71002', $SofortLibRefund->getSenderBic());
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getSenderBic());
    }
    
    
    public function testGetSenderHolder()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('Max Mustermann', $SofortLibRefund->getSenderHolder());
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getSenderHolder());
    }
    
    
    public function testGetSenderIban()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('DE471108151234567890', $SofortLibRefund->getSenderIban());
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getSenderIban());
    }
    
    
    public function testGetStatus()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('ok', $SofortLibRefund->getStatus());
        $this->assertEquals('ok', $SofortLibRefund->getStatus(0));
        $this->assertFalse($SofortLibRefund->getStatus(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getStatus());
    }
    
    
    public function testGetTime()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('00-00-0000', $SofortLibRefund->getTime());
        $this->assertEquals('00-00-0000', $SofortLibRefund->getTime(0));
        $this->assertFalse($SofortLibRefund->getTime(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getTime());
    }
    
    
    public function testGetTitle()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('Multipay API-Rückbuchung vom YYYY-MM-DD', $SofortLibRefund->getTitle());
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getTitle());
    }
    
    
    public function testGetTransactionId()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertEquals('00000-00000-00000000-0000', $SofortLibRefund->getTransactionId());
        $this->assertEquals('00000-00000-00000000-0000', $SofortLibRefund->getTransactionId(0));
        $this->assertFalse($SofortLibRefund->getTransactionId(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->getTransactionId());
    }
    
    
    public function testHandleErrors()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $handleErrors = self::_getMethod('_handleErrors', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponseError);
        $handleErrors->invoke($SofortLibRefund);
        $this->assertEquals($this->_handledErrors, $SofortLibRefund->errors);
        
        $SofortLibRefund = new Refund(self::$configkey);
        $response->setValue($SofortLibRefund, $this->_xmlResponseErrorFlat);
        $handleErrors->invoke($SofortLibRefund);
        $this->assertEquals($this->_handledErrors, $SofortLibRefund->errors);
    }
    
    
    public function testIsRefundError()
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($SofortLibRefund, $this->_xmlResponse);
        $this->assertFalse($SofortLibRefund->isRefundError());
        $this->assertFalse($SofortLibRefund->isRefundError(0));
        $this->assertFalse($SofortLibRefund->isRefundError(1));
        
        $xmlResponseEmpty = array();
        $response->setValue($SofortLibRefund, $xmlResponseEmpty);
        $this->assertFalse($SofortLibRefund->isRefundError());
        
        $response->setValue($SofortLibRefund, $this->_xmlResponseError);
        $this->assertTrue($SofortLibRefund->isRefundError());
        $this->assertTrue($SofortLibRefund->isRefundError(0));
        $this->assertFalse($SofortLibRefund->isRefundError(1));
    }
    
    
    /**
     * @dataProvider providerSetPartialRefundId
     * @param $provided
     */
    public function testSetPartialRefundId($provided)
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $SofortLibRefund->addRefund($provided[0], $provided[1], $provided[2]);
        $SofortLibRefund->setPartialRefundId($provided[3]);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals($provided[3], $received['refund'][0]['partial_refund_id']);
        
        $SofortLibRefund->addRefund($provided[0], $provided[1], $provided[2]);
        $SofortLibRefund->setPartialRefundId($provided[3]);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals($provided[3], $received['refund'][1]['partial_refund_id']);
    }
    
    
    /**
     * @dataProvider providerSetReason
     * @param $provided
     */
    public function testSetReason($provided)
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $SofortLibRefund->addRefund($provided[0], $provided[1], $provided[2]);
        $SofortLibRefund->setReason($provided[3], $provided[4]);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals(
            array(
                $provided[3],
                $provided[4]
            ),
            array(
                $received['refund'][0]['reason_1'],
                $received['refund'][0]['reason_2']
            )
        );
        
        $SofortLibRefund->addRefund($provided[0], $provided[1], $provided[2]);
        $SofortLibRefund->setReason($provided[3], $provided[4]);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals(
            array(
                $provided[3],
                $provided[4]
            ),
            array(
                $received['refund'][1]['reason_1'],
                $received['refund'][1]['reason_2']
            )
        );
    }
    
    
    /**
     * @dataProvider providerSetTitle
     * @param $provided
     */
    public function testSetTitle($provided)
    {
        $SofortLibRefund = new Refund(self::$configkey);
        $SofortLibRefund->setTitle($provided);
        $received = $SofortLibRefund->getParameters();
        $this->assertEquals($provided, $received['title']);
    }
}