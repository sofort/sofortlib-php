<?php

namespace Sofort\SofortLib;

/**
 * Class constructed just to test the methods of the abstract class
 * @author mm
 *
 */
class MultipayMock extends Multipay
{
}

class MultipayTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\MultipayMock';
    
    public function providerGetPaymentUrl()
    {
        return array(
            array('http://www.google.de'),
            array('http://www.test.de'),
        );
    }
    
    
    public function providerGetTransactionId()
    {
        return array(
            array('123324-3434354-4545454'),
            array('AS3324-45fFEr4-4545454'),
        );
    }
    
    
    public function providerSetAmount()
    {
        return array(
            array(20),
            array(10.13),
        );
    }
    
    
    public function providerSetEmailCustomer()
    {
        return array(
            array('info@sofort.com'),
            array('test@test.de'),
            array('ererererre'),
        );
    }
    
    
    public function providerSetHolder()
    {
        return array(
            array('Max Mustermann'),
        );
    }
    
    
    public function providerSetLanguageCode()
    {
        return array(
            array(array('DE', 'DE')),
            array(array('FR', 'FR')),
            array(array(null, 'EN')),
        );
    }
    
    
    public function providerSetPhoneCustomer()
    {
        return array(
            array('034545454'),
            array('045454545'),
            array('045454-454545'),
        );
    }
    
    
    /**
     * Dataprovider for testSetReason
     *
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
    
    
    public function providerSetSenderAccount()
    {
        return array(
            array(array('88888888', '12345678', 'Max Mustermann')),
        );
    }
    
    
    public function providerSetSenderBic()
    {
        return array(
            array('MARKDEFF'),
        );
    }
    
    
    public function providerSetSenderCountryCode()
    {
        return array(
            array('de'),
            array('fr'),
            array('br'),
        );
    }
    
    
    public function providerSetSenderIban()
    {
        return array(
            array('DE8888888812345678'),
        );
    }
    
    
    public function providerSetSenderSepaAccount()
    {
        return array(
            array(array('DEKTDE71002', 'DE471108151234567890', 'Max Mustermann')),
        );
    }
    
    
    public function providerSetTimeout()
    {
        return array(
            array(100),
            array(50),
            array(null),
        );
    }
    
    
    public function providerSetUserVariable()
    {
        return array(
            array('http://www.google.de'),
            array(array('http://www.sofort.com', 'http://www.heise.de')),
        );
    }
    
    
    /**
     * @dataProvider providerGetPaymentUrl
     * @param $provided
     */
    public function testGetPaymentUrl($provided)
    {
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $test['new_transaction']['payment_url']['@data'] = $provided;
        $response->setValue($SofortLibMultipayMock, $test);
        $this->assertEquals($provided, $SofortLibMultipayMock->getPaymentUrl());
    }
    
    
    public function testGetReason()
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $this->assertFalse($SofortLibMultipayMock->getReason());
        
        $expected = array();
        $expected['reasons']['reason'] = 'test';
        $SofortLibMultipayMock->setParameters($expected);
        $this->assertEquals('test', $SofortLibMultipayMock->getReason());
    }
    
    
    /**
     * @dataProvider providerGetTransactionId
     * @param $provided
     */
    public function testGetTransactionId($provided)
    {
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $test['new_transaction']['transaction']['@data'] = $provided;
        $response->setValue($SofortLibMultipayMock, $test);
        $this->assertEquals($provided, $SofortLibMultipayMock->getTransactionId());
    }
    
    
    /**
     * @dataProvider providerSetAmount
     * @param $provided
     */
    public function testSetAmount($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setAmount($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['amount']);
    }
    
    
    /**
     * @dataProvider providerSetEmailCustomer
     * @param $provided
     */
    public function testSetEmailCustomer($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setEmailCustomer($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['email_customer']);
    }
    
    
    /**
     * @dataProvider providerSetHolder
     * @param $provided
     */
    public function testSetHolder($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setSenderHolder($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['sender']['holder']);
    }
    
    
    /**
     * @dataProvider providerSetLanguageCode
     * @param $provided
     */
    public function testSetLanguageCode($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setLanguageCode($provided[0]);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided[1], $received['language_code']);
    }
    
    
    /**
     * @dataProvider providerSetPhoneCustomer
     * @param $provided
     */
    public function testSetPhoneCustomer($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setPhoneCustomer($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['phone_customer']);
    }
    
    
    /**
     * @dataProvider providerSetReason
     * @param $provided
     * @param $expected
     */
    public function testSetReason($provided, $expected)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setReason($provided[0], $provided[1]);
        $this->assertEquals($expected, $SofortLibMultipayMock->getReason());
    }
    
    
    /**
     * @dataProvider providerSetSenderAccount
     * @param $provided
     */
    public function testSetSenderAccount($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setSenderAccount($provided[0], $provided[1], $provided[2]);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, array(
            $received['sender']['bank_code'],
            $received['sender']['account_number'],
            $received['sender']['holder']
        ));
    }
    
    
    /**
     * @dataProvider providerSetSenderBic
     * @param $provided
     */
    public function testSetSenderBic($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setSenderBic($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['sender']['bic']);
    }
    
    
    /**
     * @dataProvider providerSetSenderCountryCode
     * @param $provided
     */
    public function testSetSenderCountryCode($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setSenderCountryCode($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['sender']['country_code']);
    }
    
    
    /**
     * @dataProvider providerSetSenderIban
     * @param $provided
     */
    public function testSetSenderIban($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setSenderIban($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['sender']['iban']);
    }
    
    
    /**
     * @dataProvider providerSetSenderSepaAccount
     * @param $provided
     */
    public function testSetSenderSepaAccount($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setSenderSepaAccount($provided[0], $provided[1], $provided[2]);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided,
            array($received['sender']['bic'], $received['sender']['iban'], $received['sender']['holder']));
    }
    
    
    /**
     * @dataProvider providerSetTimeout
     * @param $provided
     */
    public function testSetTimeout($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setTimeout($provided);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($provided, $received['timeout']);
    }
    
    
    /**
     * @dataProvider providerSetUserVariable
     * @param $provided
     */
    public function testSetUserVariable($provided)
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $SofortLibMultipayMock->setUserVariable($provided);
        $received = $SofortLibMultipayMock->getParameters();
        
        if (!is_array($provided)) {
            $provided = array($provided);
        }
        
        $this->assertEquals($provided, $received['user_variables']['user_variable']);
    }
    
    
    public function testSetVersion()
    {
        $SofortLibMultipayMock = new MultipayMock(self::$configkey);
        $version = '12345';
        $SofortLibMultipayMock->setVersion($version);
        $received = $SofortLibMultipayMock->getParameters();
        $this->assertEquals($version, $received['interface_version']);
    }
}