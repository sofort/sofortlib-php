<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Abstract Multipay Class
 *
 * provides attributes and methods for Invoice and SofortUeberweisung
 */
abstract class Multipay extends AbstractWrapper
{
    
    /**
     ** @var bool|string
     */
    protected $_paymentUrl;
    
    /**
     * Root Tag for the XML to be rendered
     *
     * @var string
     */
    protected $_rootTag = 'multipay';
    
    /**
     * Container for the requests transactionId
     *
     * @var string
     */
    protected $_transaction;
    
    
    /**
     * After configuration and sending this request
     * you can use this function to redirect the customer
     * to the payment form
     *
     * @return string url of payment form
     */
    public function getPaymentUrl()
    {
        $this->_paymentUrl = isset($this->_response['new_transaction']['payment_url']['@data'])
            ? $this->_response['new_transaction']['payment_url']['@data']
            : false;
        
        return $this->_paymentUrl;
    }
    
    
    /**
     * Getter for reasons
     *
     * @return string
     */
    public function getReason()
    {
        if (isset($this->_parameters['reasons']['reason'])) {
            return $this->_parameters['reasons']['reason'];
        } else {
            return false;
        }
    }
    
    
    /**
     * After configuration and sending this request
     * you can use this function to get the transactions
     * transaction ID
     *
     * @return string
     */
    public function getTransactionId()
    {
        $this->_transaction = isset($this->_response['new_transaction']['transaction']['@data'])
            ? $this->_response['new_transaction']['transaction']['@data']
            : false;
        
        return $this->_transaction;
    }
    
    
    /**
     * Setter for Amount
     *
     * @param float $amount
     * @return Multipay $this
     */
    public function setAmount($amount = 0.00)
    {
        $this->_setAmount($amount);
        
        return $this;
    }
    
    
    /**
     * Set the email address of the customer
     * this will be used for sofortvorkasse and sofortrechnung
     *
     * @param string $customersEmail email address
     * @return Multipay $this
     */
    public function setEmailCustomer($customersEmail)
    {
        $this->_parameters['email_customer'] = $customersEmail;
        
        return $this;
    }
    
    
    /**
     * Setter for languageCode
     *
     * @param string $languageCode | fallback EN
     * @return Multipay $this
     */
    public function setLanguageCode($languageCode)
    {
        $this->_parameters['language_code'] = !empty($languageCode) ? $languageCode : 'EN';
        
        return $this;
    }
    
    
    /**
     * Set the phone number of the customer
     *
     * @param string $customersPhone phone number
     * @return Multipay $this
     */
    public function setPhoneCustomer($customersPhone)
    {
        $this->_parameters['phone_customer'] = $customersPhone;
        
        return $this;
    }
    
    
    /**
     * Setter for Reasons
     *
     * @param string $reason1
     * @param string $reason2 (optional) defaults to empty string
     * @param string $productCode (optional) defaults to null
     * @return Multipay
     */
    public function setReason($reason1, $reason2 = '', $productCode = null) {
        if (!empty($reason1)) {
            $reason1 = $this->_shortenReason($reason1);
            $reason2 = (!empty($reason2)) ? $this->_shortenReason($reason2) : $reason2;
            
            if (!$productCode) {
                $this->_parameters['reasons']['reason'] = array($reason1, $reason2);
            } else {
                $this->_parameters[$productCode]['reasons']['reason'] = array($reason1, $reason2);
            }
        }
        
        return $this;
    }
    
    
    /**
     * Set data of account
     *
     * @deprecated
     * @param string $bankCode bank code of bank
     * @param string $accountNumber account number
     * @param string $holder Name/Holder of this account
     * @return Multipay $this
     */
    public function setSenderAccount($bankCode, $accountNumber, $holder)
    {
        $this->_parameters['sender'] = array(
            'bank_code' => $bankCode,
            'account_number' => $accountNumber,
            'holder' => $holder,
        );
        
        return $this;
    }
    
    
    /**
     * Setter for senders BIC
     *
     * @param string $bic
     * @return Multipay $this
     */
    public function setSenderBic($bic)
    {
        $this->_parameters['sender']['bic'] = $bic;
        
        return $this;
    }
    
    
    /**
     * Setter for senders country code (ISO 3166-1)
     *
     * @param string $countryCode
     * @return Multipay $this
     */
    public function setSenderCountryCode($countryCode)
    {
        $this->_parameters['sender']['country_code'] = $countryCode;
        
        return $this;
    }
    
    
    /**
     * Setter for senders holder (ISO 3166-1)
     *
     * @param string $holder
     * @return Multipay $this
     */
    public function setSenderHolder($holder)
    {
        $this->_parameters['sender']['holder'] = $holder;
        
        return $this;
    }
    
    
    /**
     * Setter for senders iban
     *
     * @param string $iban
     * @return Multipay $this
     */
    public function setSenderIban($iban)
    {
        $this->_parameters['sender']['iban'] = $iban;
        
        return $this;
    }
    
    
    /**
     * Set data of account, SEPA conform (iban & bic)
     *
     * @param string $bic bic of bank
     * @param string $iban iban of account
     * @param string $holder Name/Holder of this account
     * @return Multipay $this
     */
    public function setSenderSepaAccount($bic, $iban, $holder)
    {
        $this->_parameters['sender'] = array(
            'bic' => $bic,
            'iban' => $iban,
            'holder' => $holder,
        );
        
        return $this;
    }
    
    
    /**
     * Timeout how long this transaction configuration will be valid for
     * this is the time between the generation of the payment url and
     * the user completing the form, should be at least two to three minutes
     * defaults to unlimited if not set
     *
     * @param int $timeout timeout in seconds
     * @return Multipay $this
     */
    public function setTimeout($timeout)
    {
        $this->_parameters['timeout'] = $timeout;
        
        return $this;
    }
    
    
    /**
     * Add another variable this can be your internal order id or multiple variables
     *
     * @param string|array $userVariable the contents of the variable
     * @return Multipay $this
     */
    public function setUserVariable($userVariable)
    {
        if (!is_array($userVariable)) {
            $userVariable = array($userVariable);
        }
        
        $this->_parameters['user_variables']['user_variable'] = $userVariable;
        
        return $this;
    }
    
    
    /**
     * Set the version of this payment module
     * this is helpful so the support staff can easily
     * find out if someone uses an outdated module
     *
     * @param string $version version string of your module
     * @return Multipay $this
     */
    public function setVersion($version)
    {
        $this->_parameters['interface_version'] = $version;
        
        return $this;
    }
    
    
    /**
     * Setter for Amount
     *
     * @param float $amount
     * @return Multipay $this
     */
    protected function _setAmount($amount = 0.00)
    {
        $this->_parameters['amount'] = $amount;
        
        return $this;
    }
    
    
    /**
     * Shortens the reason string
     *
     * @param string $reason
     * @param string $pattern
     * @param int $reasonLength
     * @return string
     */
    protected function _shortenReason($reason, $pattern = '#[^a-zA-Z0-9+-\.,]#', $reasonLength = 27)
    {
        $reason = preg_replace($pattern, ' ', $reason);
        $reason = substr($reason, 0, $reasonLength);
        
        return $reason;
    }
}