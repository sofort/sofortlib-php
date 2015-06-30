<?php

namespace Sofort\SofortLib;

class IdealNotificationTest extends TestWrapper
{
    
    protected $_request = array(
        'transaction' => '1324-1234-5483-4891',
        'user_id' => '632',
        'project_id' => '3387',
        'reason_1' => 'Testzweck',
        'reason_2' => 'Testzweck4',
        'amount' => '10',
        'currency_id' => '',
        'sender_holder' => '31',
        'sender_account_number' => '2345678902',
        'sender_bank_code' => '31',
        'sender_bank_name' => 'ABN Amro',
        'sender_bank_bic' => '47110815',
        'sender_iban' => 'NL123456787654321',
        'sender_country_id' => 'NL',
        'recipient_holder' => 'John Doe',
        'recipient_bank_code' => '99999999',
        'recipient_bank_name' => 'Testbank',
        'recipient_bank_bic' => '08154711',
        'recipient_iban' => 'DE8888888899999999',
        'recipient_country_id' => 'DE',
        'recipient_account_number' => '88888888',
        'user_variable_0' => 'foo',
        'user_variable_1' => 'bar',
        'user_variable_2' => 'baz',
        'user_variable_3' => 'qux',
        'user_variable_4' => 'pink',
        'user_variable_5' => 'floyd',
        'hash' => '6df815a6bd7e58c8c02f083ab3cc41f01a8f1d01',
        'created' => '2013-02-02',
        'status_reason' => 'there is no reason',
        'status' => 'pending',
        'status_modified' => '2013-03-03',
    );
    
    
    public function newSofortLibIdealNotification($hashFunction = 'sha1')
    {
        return new IdealNotification(
            self::$ideal_userid,
            self::$ideal_projectid,
            self::$ideal_password, $hashFunction
        );
    }
    
    
    public function testConstruct()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $this->assertAttributeEquals(self::$ideal_userid, '_userId', $SofortLibIdealNotification);
        $this->assertAttributeEquals(self::$ideal_projectid, '_projectId', $SofortLibIdealNotification);
        $this->assertAttributeEquals(self::$ideal_password, '_password', $SofortLibIdealNotification);
        $this->assertAttributeEquals('sha1', '_hashFunction', $SofortLibIdealNotification);
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification('MD5');
        $this->assertAttributeEquals('md5', '_hashFunction', $SofortLibIdealNotification);
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification('hash');
        $this->assertAttributeEquals('hash', '_hashFunction', $SofortLibIdealNotification);
    }
    
    
    public function testGetAmount()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['amount'], $SofortLibIdealNotification->getAmount());
    }
    
    
    public function testGetCurrency()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['currency_id'], $SofortLibIdealNotification->getCurrency());
    }
    
    
    public function testGetNotification()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $this->assertTrue(
            $SofortLibIdealNotification->getNotification($this->_request) instanceof IdealNotification
        );
        $this->assertAttributeEquals(false, '_hashCheck', $SofortLibIdealNotification);
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification('md5');
        $this->assertTrue(
            $SofortLibIdealNotification->getNotification($this->_request) instanceof IdealNotification
        );
        $this->assertAttributeEquals(false, '_hashCheck', $SofortLibIdealNotification);
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification('hash');
        $this->assertTrue(
            $SofortLibIdealNotification->getNotification($this->_request) instanceof IdealNotification
        );
        $this->assertAttributeEquals(false, '_hashCheck', $SofortLibIdealNotification);
        
        $hash_algo_test = hash_algos();
        
        if (is_array($hash_algo_test)) {
            $SofortLibIdealNotification = $this->newSofortLibIdealNotification($hash_algo_test[0]);
            $this->assertTrue(
                $SofortLibIdealNotification->getNotification($this->_request) instanceof IdealNotification
            );
        }
    }
    
    
    public function testGetStatus()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['status'], $SofortLibIdealNotification->getStatus());
    }
    
    
    public function testGetStatusReason()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['status_reason'], $SofortLibIdealNotification->getStatusReason());
    }
    
    
    public function testGetTime()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['created'], $SofortLibIdealNotification->getTime());
    }
    
    
    public function testGetTransaction()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['transaction'], $SofortLibIdealNotification->getTransaction());
    }
    
    
    public function testGetUserVariable()
    {
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_0'], $SofortLibIdealNotification->getUserVariable());
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_0'], $SofortLibIdealNotification->getUserVariable(0));
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_1'], $SofortLibIdealNotification->getUserVariable(1));
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_2'], $SofortLibIdealNotification->getUserVariable(2));
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_3'], $SofortLibIdealNotification->getUserVariable(3));
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_4'], $SofortLibIdealNotification->getUserVariable(4));
        
        $SofortLibIdealNotification = $this->newSofortLibIdealNotification();
        $SofortLibIdealNotification->getNotification($this->_request);
        $this->assertEquals($this->_request['user_variable_5'], $SofortLibIdealNotification->getUserVariable(5));
    }
}