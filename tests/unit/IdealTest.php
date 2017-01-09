<?php

namespace Sofort\SofortLib;

class IdealTest extends TestWrapper
{
    
    
    public function providerSetAbortUrl()
    {
        return array(
            array('http://www.sofort.com'),
        );
    }
    
    
    public function providerSetNotificationUrl()
    {
        return array(
            array('http://www.google.de'),
        );
    }
    
    
    public function providerSetReason()
    {
        return array(
            array(array('Testzweck', 'Testzweck4',),),
        );
    }
    
    
    public function providerSetSenderAccountNumber()
    {
        return array(
            array('2345678902',),
        );
    }
    
    
    public function providerSetSenderBankCode()
    {
        return array(
            array('31',),
        );
    }
    
    
    public function providerSetSenderCountryId()
    {
        return array(
            array('31',),
        );
    }
    
    
    public function providerSetSenderHolder()
    {
        return array(
            array('31',),
        );
    }
    
    
    public function providerSetSuccessUrl()
    {
        return array(
            array('http://www.klarna.com'),
        );
    }
    
    
    public function testGetHashHexValue()
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $data = 'abcdefgh';
        
        $dataSha1 = $SofortIdeal->getHashHexValue($data);
        $this->assertEquals($dataSha1, sha1($data));
        
        $dataSha1 = $SofortIdeal->getHashHexValue($data, 'sha1');
        $this->assertEquals($dataSha1, sha1($data));
        
        $dataMd5 = $SofortIdeal->getHashHexValue($data, 'md5');
        $this->assertEquals($dataMd5, md5($data));
        
        $hashFunctions = hash_algos();
        $dataHashAlgo = $SofortIdeal->getHashHexValue($data, $hashFunctions[0]);
        $this->assertEquals($dataHashAlgo, hash($hashFunctions[0], $data));
        
        $dataFalse = $SofortIdeal->getHashHexValue($data, 'false');
        $this->assertFalse($dataFalse);
    }
    
    
    public function testGetPaymentUrl()
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        
        $this->assertAttributeEquals(self::$ideal_password, '_password', $SofortIdeal);
        $this->assertAttributeEquals(self::$ideal_userid, '_userId', $SofortIdeal);
        $this->assertAttributeEquals(self::$ideal_projectid, '_projectId', $SofortIdeal);
        $this->assertAttributeEquals(strtolower('sha1'), '_hashFunction', $SofortIdeal);
        
        $SofortIdeal->setReason('Testzweck', 'Testzweck4');
        $SofortIdeal->setAmount(10);
        $SofortIdeal->setSenderAccountNumber('2345678902');
        $SofortIdeal->setSenderBankCode('31');
        $SofortIdeal->setSenderCountryId('NL');
        $SofortIdeal->setSuccessUrl('http://www.google.de');
        $SofortIdeal->setAbortUrl('http://www.google.de');
        $SofortIdeal->setNotificationUrl('http://www.google.de');
        $SofortIdeal->setVersion('Framework 0.0.1');
        
        $getPaymentUrl = $SofortIdeal->getPaymentUrl();
        $hashFields = array(
            'user_id' => self::$ideal_userid,
            'project_id' => self::$ideal_projectid,
            'sender_holder' => '',
            'sender_account_number' => '2345678902',
            'sender_bank_code' => '31',
            'sender_country_id' => 'NL',
            'amount' => 10,
            'reason_1' => 'Testzweck',
            'reason_2' => 'Testzweck4',
            'user_variable_0' => '',
            'user_variable_1' => '',
            'user_variable_2' => '',
            'user_variable_3' => 'http://www.google.de',
            'user_variable_4' => 'http://www.google.de',
            'user_variable_5' => 'http://www.google.de',
        );
        $hashString = '';
        
        foreach ($hashFields as $value) {
            $hashString .= $value;
            $hashString .= '|';
        }
        
        $hashString .= self::$ideal_password;
        $hashStringSha1 = sha1($hashString);
        $urlSha1 = 'https://www.sofort.com/payment/ideal?'
            . 'user_id=' . self::$user_id
            . '&project_id=' . self::$project_id
            . '&reason_1=Testzweck&reason_2=Testzweck4&amount=10'
            . '&sender_account_number=2345678902&sender_bank_code=31&sender_country_id=NL'
            . '&user_variable_3=http%3A%2F%2Fwww.google.de&success_link_redirect=1&user_variable_4=http%3A%2F%2Fwww.google.de'
            . '&user_variable_5=http%3A%2F%2Fwww.google.de&interface_version=Framework+0.0.1'
            . '&hash=' . $hashStringSha1;
        $this->assertEquals($urlSha1, $getPaymentUrl);
        
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password, 'md5');
        $this->assertAttributeEquals(strtolower('md5'), '_hashFunction', $SofortIdeal);
        
        $SofortIdeal->setReason('Testzweck', 'Testzweck4');
        $SofortIdeal->setAmount(10);
        $SofortIdeal->setSenderAccountNumber('2345678902');
        $SofortIdeal->setSenderBankCode('31');
        $SofortIdeal->setSenderCountryId('NL');
        $SofortIdeal->setSuccessUrl('http://www.google.de');
        $SofortIdeal->setAbortUrl('http://www.google.de');
        $SofortIdeal->setNotificationUrl('http://www.google.de');
        $SofortIdeal->setVersion('Framework 0.0.1');
        
        $getPaymentUrl = $SofortIdeal->getPaymentUrl();
        $hashStringMd5 = md5($hashString);
        $urlMd5 = 'https://www.sofort.com/payment/ideal?'
            . 'user_id=' . self::$user_id
            . '&project_id=' . self::$project_id
            . '&reason_1=Testzweck&reason_2=Testzweck4&amount=10'
            . '&sender_account_number=2345678902&sender_bank_code=31&sender_country_id=NL'
            . '&user_variable_3=http%3A%2F%2Fwww.google.de&success_link_redirect=1&user_variable_4=http%3A%2F%2Fwww.google.de'
            . '&user_variable_5=http%3A%2F%2Fwww.google.de&interface_version=Framework+0.0.1'
            . '&hash=' . $hashStringMd5;
        $this->assertEquals($urlMd5, $getPaymentUrl);
        
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password, 'wuselschnusel');
        $this->assertAttributeEquals(strtolower('wuselschnusel'), '_hashFunction', $SofortIdeal);
        
        $SofortIdeal->setReason('Testzweck', 'Testzweck4');
        $SofortIdeal->setAmount(10);
        $SofortIdeal->setSenderAccountNumber('2345678902');
        $SofortIdeal->setSenderBankCode('31');
        $SofortIdeal->setSenderCountryId('NL');
        $SofortIdeal->setSuccessUrl('http://www.google.de');
        $SofortIdeal->setAbortUrl('http://www.google.de');
        $SofortIdeal->setNotificationUrl('http://www.google.de');
        $SofortIdeal->setVersion('Framework 0.0.1');
        
        $getPaymentUrl = $SofortIdeal->getPaymentUrl();
        $urlWuselschnusel = 'https://www.sofort.com/payment/ideal?'
            . 'user_id=' . self::$user_id
            . '&project_id=' . self::$project_id
            . '&reason_1=Testzweck&reason_2=Testzweck4&amount=10'
            . '&sender_account_number=2345678902&sender_bank_code=31&sender_country_id=NL'
            . '&user_variable_3=http%3A%2F%2Fwww.google.de&success_link_redirect=1&user_variable_4=http%3A%2F%2Fwww.google.de'
            . '&user_variable_5=http%3A%2F%2Fwww.google.de&interface_version=Framework+0.0.1'
            . '&hash=';
        $this->assertEquals($urlWuselschnusel, $getPaymentUrl);
        
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password, 'sha256');
        $this->assertAttributeEquals(strtolower('sha256'), '_hashFunction', $SofortIdeal);
        
        $SofortIdeal->setReason('Testzweck', 'Testzweck4');
        $SofortIdeal->setAmount(10);
        $SofortIdeal->setSenderAccountNumber('2345678902');
        $SofortIdeal->setSenderBankCode('31');
        $SofortIdeal->setSenderCountryId('NL');
        $SofortIdeal->setSuccessUrl('http://www.google.de');
        $SofortIdeal->setAbortUrl('http://www.google.de');
        $SofortIdeal->setNotificationUrl('http://www.google.de');
        $SofortIdeal->setVersion('Framework 0.0.1');
        
        $getPaymentUrl = $SofortIdeal->getPaymentUrl();
        $hashStringSha256 = hash('Sha256', $hashString);
        $urlSha256 = 'https://www.sofort.com/payment/ideal?'
            . 'user_id=' . self::$user_id
            . '&project_id=' . self::$project_id
            . '&reason_1=Testzweck&reason_2=Testzweck4&amount=10'
            . '&sender_account_number=2345678902&sender_bank_code=31&sender_country_id=NL'
            . '&user_variable_3=http%3A%2F%2Fwww.google.de&success_link_redirect=1&user_variable_4=http%3A%2F%2Fwww.google.de'
            . '&user_variable_5=http%3A%2F%2Fwww.google.de&interface_version=Framework+0.0.1'
            . '&hash=' . $hashStringSha256;
        $this->assertEquals($urlSha256, $getPaymentUrl);
    }
    
    
    /**
     * @dataProvider providerSetAbortUrl
     * @param string $provided
     */
    public function testSetAbortUrl($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setAbortUrl($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['user_variable_4']);
    }
    
    
    /**
     * @dataProvider providerSetNotificationUrl
     * @param string $provided
     */
    public function testSetNotificationUrl($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setNotificationUrl($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['user_variable_5']);
    }
    
    
    /**
     * @dataProvider providerSetReason
     * @param array $provided
     */
    public function testSetReason(array $provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setReason($provided[0], $provided[1]);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided[0], $received['reason_1']);
        $this->assertEquals($provided[1], $received['reason_2']);
    }
    
    
    /**
     * @dataProvider providerSetSenderAccountNumber
     * @param string $provided
     */
    public function testSetSenderAccountNumber($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setSenderAccountNumber($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['sender_account_number']);
    }
    
    
    /**
     * @dataProvider providerSetSenderBankCode
     * @param string $provided
     */
    public function testSetSenderBankCode($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setSenderBankCode($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['sender_bank_code']);
    }
    
    
    /**
     * @dataProvider providerSetSenderCountryId
     * @param string $provided
     */
    public function testSetSenderCountryId($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setSenderCountryId($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['sender_country_id']);
    }
    
    /**
     * @dataProvider providerSetSenderHolder
     * @param string $provided
     */
    public function testSetSenderHolder($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setSenderHolder($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['sender_holder']);
    }
    
    
    /**
     * @dataProvider providerSetSuccessUrl
     * @param string $provided
     */
    public function testSetSuccessUrl($provided)
    {
        $SofortIdeal = new Ideal(self::$ideal_configkey, self::$ideal_password);
        $SofortIdeal->setSuccessUrl($provided);
        $received = $SofortIdeal->getParameters();
        $this->assertEquals($provided, $received['user_variable_3']);
    }
}