<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * This class handles incoming ideal notifications
 */
class IdealNotification
{
    
    /**
     * Holds the notification data
     *
     * @var array
     */
    public $params = array();
    
    /**
     * Boolean, whether hash check was successful
     *
     * @var bool
     */
    private $_hashCheck = false;
    
    /**
     * Container for the hash function to be used
     *
     * @var string
     */
    private $_hashFunction;
    
    /**
     * Ideal Password
     *
     * @var string
     */
    private $_password;
    
    /**
     * Project-ID from sofort.com
     *
     * @var string
     */
    private $_projectId;
    
    /**
     * Contains the reason for the status
     *
     * @var bool|string
     */
    private $_statusReason;
    
    /**
     * User-ID from sofort.com
     *
     * @var string
     */
    private $_userId;
    
    
    /**
     * Constructor for sofortLibIdealNotification
     *
     * @param int $userId
     * @param int $projectId
     * @param string $password
     * @param string $hashFunction (default sha1)
     */
    public function __construct($userId, $projectId, $password, $hashFunction = 'sha1')
    {
        $this->_password = $password;
        $this->_userId = $userId;
        $this->_projectId = $projectId;
        $this->_hashFunction = strtolower($hashFunction);
        $this->_statusReason = false;
    }
    
    
    /**
     * Getter for amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->params['amount'];
    }
    
    
    /**
     * Getter for currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->params['currency_id'];
    }
    
    
    /**
     * Get the notification details
     *
     * @param string $request (POST-Data)
     * @return IdealNotification $this
     */
    public function getNotification($request)
    {
        if (array_key_exists('status_reason', $request) && !empty($request['status_reason'])) {
            $this->_statusReason = $request['status_reason'];
        }
        
        // ideal
        $fields = array(
            'transaction',
            'user_id',
            'project_id',
            'sender_holder',
            'sender_account_number',
            'sender_bank_name',
            'sender_bank_bic',
            'sender_iban',
            'sender_country_id',
            'recipient_holder',
            'recipient_account_number',
            'recipient_bank_code',
            'recipient_bank_name',
            'recipient_bank_bic',
            'recipient_iban',
            'recipient_country_id',
            'amount',
            'currency_id',
            'reason_1',
            'reason_2',
            'user_variable_0',
            'user_variable_1',
            'user_variable_2',
            'user_variable_3',
            'user_variable_4',
            'user_variable_5',
            'created',
        );
        
        // http-notification with status
        if (array_key_exists('status', $request) && !empty($request['status'])) {
            array_push($fields, 'status', 'status_modified');
        }
        
        $this->params = array();
        
        foreach ($fields as $key) {
            $this->params[$key] = $request[$key];
        }
        
        $this->params['project_password'] = $this->_password;
        $validationHash = $this->_getHashHexValue(implode('|', $this->params), $this->_hashFunction);
        $messageHash = $request['hash'];
        $this->_hashCheck = ($validationHash === $messageHash);
        
        return $this;
    }
    
    
    /**
     * Getter for status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->params['status'];
    }
    
    
    /**
     * Getter for status reason
     *
     * @return string
     */
    public function getStatusReason()
    {
        return $this->_statusReason;
    }
    
    
    /**
     * Getter for time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->params['created'];
    }
    
    
    /**
     * Getter for transactionId
     *
     * @return string
     */
    public function getTransaction()
    {
        return $this->params['transaction'];
    }
    
    
    /**
     * Getter for user variables
     *
     * @param int $i (default 0)
     * @return string
     */
    public function getUserVariable($i = 0)
    {
        return $this->params['user_variable_' . $i];
    }
    
    
    /**
     * Getter for Hash Hex Value
     *
     * @param string $data string to be hashed
     * @param string $hashFunction (default sha1)
     * @return string the hash
     */
    protected function _getHashHexValue($data, $hashFunction = 'sha1')
    {
        if ($hashFunction == 'sha1') {
            return sha1($data);
        }
        
        if ($hashFunction == 'md5') {
            return md5($data);
        }
        
        // mcrypt installed?
        if (function_exists('hash') && in_array($hashFunction, hash_algos())) {
            return hash($hashFunction, $data);
        }
        
        return false;
    }
}