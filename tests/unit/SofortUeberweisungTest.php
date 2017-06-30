<?php

namespace Sofort\SofortLib;

class SofortueberweisungTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\Sofortueberweisung';
    
    private $_responseErrors = array(
        'errors' => array(
            'error' => array(
                0 => array(
                    'code' => array(
                        "@data" => 8068,
                        "@attributes" => array(),
                    ),
                    'message' => array(
                        "@data" => "Payment type invoice not available for business customers.",
                        "@attributes" => array(),
                    ),
                ),
                1 => array(
                    'code' => array(
                        "@data" => 8054,
                        "@attributes" => array(),
                    ),
                    'message' => array(
                        "@data" => "All products deactivated due to errors, initiation aborted.",
                        "@attributes" => array(),
                    ),
                ),
            ),
            'su' => array(
                'errors' => array(
                    'error' => array(
                        0 => array(
                            'code' => array(
                                "@data" => 8068,
                                "@attributes" => array(),
                            ),
                            'message' => array(
                                "@data" => "Payment type invoice not available for business customers.",
                                "@attributes" => array(),
                            ),
                            'field' => array(
                                "@data" => "invoice_address.salutation",
                                "@attributes" => array(),
                            ),
                        ),
                        1 => array(
                            'code' => array(
                                "@data" => 8068,
                                "@attributes" => array(),
                            ),
                            'message' => array(
                                "@data" => "Payment type invoice not available for business customers.",
                                "@attributes" => array(),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );
    
    private $_responseErrorsFlat = array(
        'errors' => array(
            'error' => array(
                'code' => array(
                    "@data" => 8068,
                    "@attributes" => array(),
                ),
                'message' => array(
                    "@data" => "Payment type invoice not available for business customers.",
                    "@attributes" => array(),
                ),
            ),
            'su' => array(
                'errors' => array(
                    'error' => array(
                        'code' => array(
                            "@data" => 8068,
                            "@attributes" => array(),
                        ),
                        'message' => array(
                            "@data" => "Payment type invoice not available for business customers.",
                            "@attributes" => array(),
                        ),
                        'field' => array(
                            "@data" => "invoice_address.salutation",
                            "@attributes" => array(),
                        ),
                    ),
                ),
            ),
        ),
    );
    
    private $_handledErrorsFlat = array(
        'global' => array(
            0 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => '',
            ),
        ),
        'su' => array(
            0 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => 'invoice_address.salutation',
            ),
        ),
    );
    
    private $_handledErrors = array(
        'global' => array(
            0 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => '',
            ),
            1 => array(
                'code' => 8054,
                'message' => 'All products deactivated due to errors, initiation aborted.',
                'field' => '',
            ),
        ),
        'su' => array(
            0 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => 'invoice_address.salutation',
            ),
            1 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => '',
            ),
        ),
    );
    
    private $_responseWarnings = array(
        'new_transaction' => array(
            'warnings' => array(
                'warning' => array(
                    0 => array(
                        'code' => array(
                            "@data" => 8068,
                            "@attributes" => array(),
                        ),
                        'message' => array(
                            "@data" => "Payment type invoice not available for business customers.",
                            "@attributes" => array(),
                        ),
                        'field' => array(
                            "@data" => "invoice_address.salutation",
                            "@attributes" => array(),
                        ),
                    ),
                    1 => array(
                        'code' => array(
                            "@data" => 8054,
                            "@attributes" => array(),
                        ),
                        'message' => array(
                            "@data" => "All products deactivated due to errors, initiation aborted.",
                            "@attributes" => array(),
                        ),
                    ),
                ),
                'su' => array(
                    'warnings' => array(
                        'warning' => array(
                            0 => array(
                                'code' => array(
                                    "@data" => 9007,
                                    "@attributes" => array(),
                                ),
                                'message' => array(
                                    "@data" => "Comfortably Numb.",
                                    "@attributes" => array(),
                                ),
                            ),
                            1 => array(
                                'code' => array(
                                    "@data" => 9008,
                                    "@attributes" => array(),
                                ),
                                'message' => array(
                                    "@data" => "Lorem Ipsim.",
                                    "@attributes" => array(),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );
    
    private $_responseWarningsFlat = array(
        'new_transaction' => array(
            'warnings' => array(
                'warning' => array(
                    'code' => array(
                        "@data" => 8068,
                        "@attributes" => array(),
                    ),
                    'message' => array(
                        "@data" => "Payment type invoice not available for business customers.",
                        "@attributes" => array(),
                    ),
                    'field' => array(
                        "@data" => "invoice_address.salutation",
                        "@attributes" => array(),
                    ),
                ),
                'su' => array(
                    'warnings' => array(
                        'warning' => array(
                            'code' => array(
                                "@data" => 9007,
                                "@attributes" => array(),
                            ),
                            'message' => array(
                                "@data" => "Comfortably Numb.",
                                "@attributes" => array(),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );
    
    private $_handledWarnings = array(
        'global' => array(
            0 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => 'invoice_address.salutation',
            ),
            1 => array(
                'code' => 8054,
                'message' => 'All products deactivated due to errors, initiation aborted.',
                'field' => '',
            ),
        ),
        'su' => array(
            0 => array(
                'code' => 9007,
                'message' => 'Comfortably Numb.',
                'field' => '',
            ),
            1 => array(
                'code' => 9008,
                'message' => 'Lorem Ipsim.',
                'field' => '',
            ),
        ),
    );
    
    private $_handledWarningsFlat = array(
        'global' => array(
            0 => array(
                'code' => 8068,
                'message' => 'Payment type invoice not available for business customers.',
                'field' => 'invoice_address.salutation',
            ),
        ),
        'su' => array(
            0 => array(
                'code' => 9007,
                'message' => 'Comfortably Numb.',
                'field' => '',
            ),
        ),
    );
    
    
    public function providerSetCustomerprotection()
    {
        return array(
            array(array(1, true)),
            array(array(0, false)),
        );
    }
    
    
    /**
     * Dataprovider for testSetReason
     * @return array
     */
    public function providerSetReason()
    {
        return array(
            array(array('Verwendungszweck', 'Zweite Zeile'), array('Verwendungszweck', 'Zweite Zeile')),
            array(array('Verwendungszweck', null), array('Verwendungszweck', '')),
            array(
                array('Verwendungszweck', '123456789012345678901234567890'),
                array('Verwendungszweck', '123456789012345678901234567890')
            ),
            array(array('Verwendungszweck', 'test@test'), array('Verwendungszweck', 'test@test')),
        );
    }
    
    
    public function providerSetVersion()
    {
        return array(
            array('1.1'),
            array('2.1'),
        );
    }
    
    
    public function testHandleErrors()
    {
        $Sofortueberweisung = new Sofortueberweisung(self::$configkey);
        $response = self::_getProperty('_response', $this->_classToTest);
        $handleErrors = self::_getMethod('_handleErrors', $this->_classToTest);
        $response->setValue($Sofortueberweisung, $this->_responseWarnings);
        $handleErrors->invoke($Sofortueberweisung);
        $this->assertEquals($this->_handledWarnings, $Sofortueberweisung->warnings);
        
        $response->setValue($Sofortueberweisung, $this->_responseErrors);
        $handleErrors->invoke($Sofortueberweisung);
        $this->assertEquals($this->_handledErrors, $Sofortueberweisung->errors);
        
        $Sofortueberweisung = new Sofortueberweisung(self::$configkey);
        $response->setValue($Sofortueberweisung, $this->_responseWarningsFlat);
        $handleErrors->invoke($Sofortueberweisung);
        $this->assertEquals($this->_handledWarningsFlat, $Sofortueberweisung->warnings);
        
        $response->setValue($Sofortueberweisung, $this->_responseErrorsFlat);
        $handleErrors->invoke($Sofortueberweisung);
        $this->assertEquals($this->_handledErrorsFlat, $Sofortueberweisung->errors);
    }
    
    
    public function testParser()
    {
        $Sofortueberweisung = new Sofortueberweisung(self::$configkey);
        $Sofortueberweisung->setConfigKey(self::$configkey);
        $XmlDataHandler = new XmlDataHandler(self::$configkey);
        
        //mock http
        $http = $this->getMock('Sofort\SofortLib\AbstractHttp', array('post'), array(self::$testapi_url));
        $http->expects($this->any())->method('post')->will($this->returnArgument(0));
        $XmlDataHandler->setConnection($http);
        
        $Sofortueberweisung->setAmount(10.21);
        $Sofortueberweisung->setCurrencyCode('EUR');
        $Sofortueberweisung->setSenderAccount('88888888', '12345678', 'Max Mustermann');
        $Sofortueberweisung->setReason('Testueberweisung', 'Verwendungszweck');
        $Sofortueberweisung->setSuccessUrl('http://www.google.de', true);
        $Sofortueberweisung->setAbortUrl('http://www.google.de');
        $Sofortueberweisung->setNotificationUrl('http://www.google.de');
        
        $data = $Sofortueberweisung->getData();
        
        /* hand over data */
        $Sofortueberweisung->setDataHandler($XmlDataHandler)->getDataHandler()->handle($data);
        
        // assert we have a good looking result
        $result = $Sofortueberweisung->getDataHandler()->getRequest();
        
        $expected = '<?xml version="1.0" encoding="UTF-8" ?>
<multipay version="1.0"><su /><amount>10.21</amount><currency_code>EUR</currency_code><sender><bank_code>88888888</bank_code><account_number>12345678</account_number><holder>Max Mustermann</holder></sender><reasons><reason>Testueberweisung</reason><reason>Verwendungszweck</reason></reasons><success_url>http://www.google.de</success_url><success_link_redirect>1</success_link_redirect><abort_url>http://www.google.de</abort_url><notification_urls><notification_url>http://www.google.de</notification_url></notification_urls><project_id>' . self::$project_id . '</project_id></multipay>';
        //var_dump($result);
        $this->assertEquals($expected, $result);
    }
    
    
    /**
     * @dataProvider providerSetCustomerprotection
     * @param $provided
     */
    public function testSetCustomerprotection($provided)
    {
        $Sofortueberweisung = new Sofortueberweisung(self::$configkey);
        $Sofortueberweisung->setCustomerprotection($provided[0]);
        $received = $Sofortueberweisung->getParameters();
        $this->assertSame($provided[0], $received['su']['customer_protection']);
        $this->assertNotSame($provided[1], $received['su']['customer_protection']);
        
        $parameters = self::_getProperty('_parameters', $this->_classToTest);
        $parameters->setValue($Sofortueberweisung, array('test' => 'test'));
        $Sofortueberweisung->setCustomerprotection($provided[0]);
        $received = $Sofortueberweisung->getParameters();
        $this->assertEquals($provided[0], $received['su']['customer_protection']);
    }
    
    
    /**
     * @dataProvider providerSetReason
     * @param $provided
     * @param $expected
     */
    public function testSetReason($provided, $expected)
    {
        $Sofortueberweisung = new Sofortueberweisung(self::$configkey);
        $Sofortueberweisung->setReason($provided[0], $provided[1]);
        $this->assertEquals($expected, $Sofortueberweisung->getReason());
    }
    
    
    /**
     * @dataProvider providerSetVersion $provided
     * @param $provided
     */
    public function testSetVersion($provided)
    {
        $Sofortueberweisung = new Sofortueberweisung(self::$configkey);
        $Sofortueberweisung->setVersion($provided);
        $received = $Sofortueberweisung->getParameters();
        $this->assertEquals($provided, $received['interface_version']);
    }
}