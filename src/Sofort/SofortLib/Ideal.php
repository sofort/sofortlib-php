<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Extends Multipay to deal with iDeal transactions
 */
class Ideal extends Multipay
{
    
    const IDEAL_URL = 'https://www.sofort.com/payment/ideal';
    
    /**
     * Fields to be sent with the request
     *
     * @var array
     */
    protected $_hashFields = array(
        'user_id',
        'project_id',
        'sender_holder',
        'sender_account_number',
        'sender_bank_code',
        'sender_country_id',
        'amount',
        'reason_1',
        'reason_2',
        'user_variable_0',
        'user_variable_1',
        'user_variable_2',
        'user_variable_3',
        'user_variable_4',
        'user_variable_5',
    );
    
    /**
     * Password to be sent to the API
     *
     * @var string
     */
    protected $_password;
    
    /**
     * API-URL
     *
     * @var string
     */
    protected $_paymentUrl = self::IDEAL_URL;
    
    /**
     * Container for the hash function to be used
     *
     * @var string
     */
    private $_hashFunction;
    
    /**
     * Constructor for Ideal
     *
     * @param string $configKey
     * @param string $password
     * @param string $hashFunction (default sha1)
     */
    public function __construct($configKey, $password, $hashFunction = 'sha1')
    {
        parent::__construct($configKey);
        list($userId, $projectId) = explode(':', $configKey);
        $this->_password = $password;
        $this->_userId = $this->_parameters['user_id'] = $userId;
        $this->_projectId = $this->_parameters['project_id'] = $projectId;
        $this->_hashFunction = strtolower($hashFunction);
        $this->_paymentUrl = $this->_getPaymentDomain();
    }
    
    
    /**
     * Get the hash value
     *
     * @param string $data string to be hashed
     * @param string @hashFunction (default sha1)
     * @return string the hash
     */
    public function getHashHexValue($data, $hashFunction = 'sha1')
    {
        if ($hashFunction == 'sha1') {
            return sha1($data);
        }
        if ($hashFunction == 'md5') {
            return md5($data);
        }
        
        //mcrypt installed?
        if (function_exists('hash') && in_array($hashFunction, hash_algos())) {
            return hash($hashFunction, $data);
        }
        
        return false;
    }
    
    
    /**
     * Getter for payment URL
     *
     * @return string Url
     */
    public function getPaymentUrl()
    {
        //fields required for hash
        $hashFields = $this->_hashFields;
        //build parameter-string for hashing
        $hashString = '';
        
        foreach ($hashFields as $value) {
            if (array_key_exists($value, $this->_parameters)) {
                $hashString .= $this->_parameters[$value];
            }
            
            $hashString .= '|';
        }
        
        $hashString .= $this->_password;
        //calculate hash
        $hash = $this->getHashHexValue($hashString, $this->_hashFunction);
        $this->_parameters['hash'] = $hash;
        //create parameter string
        $paramString = '';
        
        foreach ($this->_parameters as $key => $value) {
            $paramString .= $key . '=' . urlencode($value) . '&';
        }
        
        $paramString = substr($paramString, 0, -1); //remove last "&"
        
        return $this->_paymentUrl . '?' . $paramString;
    }
    
    
    /**
     * Set the url where you want forward after successful transaction
     *
     * @param string $abortUrl url
     * @return Ideal $this
     */
    public function setAbortUrl($abortUrl)
    {
        $this->_parameters['user_variable_4'] = $abortUrl;
        
        return $this;
    }
    
    
    /**
     * Setter for Amount
     *
     * @param float $amount
     * @return Ideal
     */
    public function setAmount($amount = 0.00)
    {
        $this->_setAmount($amount);
        
        return $this;
    }
    
    
    /**
     * Set the url where you want notification about status changes
     * being sent to. Use SofortLibTransactionData
     * to further process that notification
     *
     * @param string $notificationUrl url
     * @param string $notifyOn
     * @return Ideal
     */
    public function setNotificationUrl($notificationUrl, $notifyOn = '')
    {
        $this->_parameters['user_variable_5'] = $notificationUrl;
        
        return $this;
    }
    
    
    /**
     * Set the reason (Verwendungszweck) for sending money
     *
     * @param string $reason1
     * @param string $reason2 (optional)
     * @param string $productCode (unused in this implementation)
     * 
     * @return Ideal
     */
    public function setReason($reason1, $reason2 = '', $productCode = null)
    {
        $this->_parameters['reason_1'] = preg_replace('#[^a-zA-Z0-9+-\.,]#', ' ', $reason1);
        $this->_parameters['reason_2'] = preg_replace('#[^a-zA-Z0-9+-\.,]#', ' ', $reason2);
        
        return $this;
    }
    
    
    /**
     * Setter for sender's account number
     *
     * @param string $senderAccountNumber
     * @return string
     */
    public function setSenderAccountNumber($senderAccountNumber)
    {
        $this->_parameters['sender_account_number'] = $senderAccountNumber;
        
        return $this;
    }
    
    
    /**
     * Set sender's bank code
     *
     * @param string $senderBankCode
     * @return Ideal
     */
    public function setSenderBankCode($senderBankCode)
    {
        $this->_parameters['sender_bank_code'] = $senderBankCode;
        
        return $this;
    }
    
    
    /**
     * Set sender's country id
     *
     * @param string $senderCountryId (default NL)
     * @return Ideal
     */
    public function setSenderCountryId($senderCountryId = 'NL')
    {
        $this->_parameters['sender_country_id'] = $senderCountryId;
        
        return $this;
    }
    
    
    /**
     * Setter for sender and holder
     *
     * @param string $senderHolder
     * @return Ideal
     */
    public function setSenderHolder($senderHolder)
    {
        $this->_parameters['sender_holder'] = $senderHolder;
        
        return $this;
    }
    
    
    /**
     * The customer will be redirected to this url after a successful
     * transaction, this should be a page where a short confirmation is
     * displayed
     *
     * @param string $successUrl url
     * @param bool $redirect (default true)
     * @return Ideal
     */
    public function setSuccessUrl($successUrl, $redirect = true)
    {
        $this->_parameters['user_variable_3'] = $successUrl;
        $this->setSuccessLinkRedirect($redirect);
        
        return $this;
    }
    
    
    /**
     * Getter for the payment domain
     *
     * @return string
     */
    protected function _getPaymentDomain()
    {
        return (getenv('idealApiUrl') != '') ? getenv('idealApiUrl') : $this->_paymentUrl;
    }
}