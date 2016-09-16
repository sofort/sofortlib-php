<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * This class is  for retrieving details about pay- & billcodes
 */
abstract class PaycodeDetailsAbstract extends AbstractWrapper
{
    
    /**
     * Root for Bill/Paycode.
     *
     * @var string
     */
    protected $_root = 'paycode';
    
    /**
     * Root tag for the XML-Request
     *
     * @var string
     */
    protected $_rootTag = 'paycode_request';
    
    
    /**
     * Getter for the Bill/Paycodes amount
     *
     * @return string|bool
     */
    public function getAmount()
    {
        return $this->_extractValue('amount');
    }
    
    
    /**
     * Getter for the Bill/Paycodes currency code (EUR|...)
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->_extractValue('currency_code');
    }
    
    
    /**
     * Getter for the end date of the Bill/Paycode
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->_extractValue('end_date');
    }
    
    
    /**
     * Getter for the Bill/Paycodes language code (de|...)
     *
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->_extractValue('language_code');
    }
    
    
    /**
     * Getter for the project-ID the Bill/Paycode belongs to
     *
     * @return string|bool
     */
    public function getProjectId()
    {
        return $this->_extractValue('project_id');
    }
    
    
    /**
     * Getter for the Bill/Paycodes reason (0 => reason line 1, 1 => reason line 2)
     *
     * @param int $n (default 0)
     * @return mixed|bool
     */
    public function getReason($n = 0)
    {
        return $this->_extractValue('reason', 'reasons', $n);
    }
    
    
    /**
     * Getter for the senders bank code
     *
     * @return string
     */
    public function getSenderBankCode()
    {
        return $this->_extractValue('bank_code', 'sender');
    }
    
    
    /**
     * Getter for the senders BIC
     *
     * @return string
     */
    public function getSenderBic()
    {
        return $this->_extractValue('bic', 'sender');
    }
    
    
    /**
     * Getter for the senders country code
     *
     * @return string
     */
    public function getSenderCountryCode()
    {
        return $this->_extractValue('country_code', 'sender');
    }
    
    
    /**
     * Getter for the Bill/Paycodes start date
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->_extractValue('start_date');
    }
    
    
    /**
     * Getter for the Bill/Paycodes status
     *
     * @return string (open|used|expired)
     */
    public function getStatus()
    {
        return $this->_extractValue('status');
    }
    
    
    /**
     * Getter for the time Bill/Paycode was created
     *
     * @return string
     */
    public function getTimeCreated()
    {
        return $this->_extractValue('time_created');
    }
    
    
    /**
     * Getter for the time Bill/Paycode was used
     *
     * @return string
     */
    public function getTimeUsed()
    {
        return $this->_extractValue('time_used');
    }
    
    
    /**
     * Getter for the transaction-ID the Bill/Paycode belongs to
     *
     * @return string|bool
     */
    public function getTransaction()
    {
        return $this->_extractValue('transaction');
    }
    
    
    /**
     * Returns the user variable of a transaction
     *
     * @param int $n number of the variable (which row; default 0)
     * @return string the content of this variable
     */
    public function getUserVariable($n = 0)
    {
        return $this->_extractValue('variable', 'user_variables', $n);
    }
    
    
    /**
     * Sets the root tag and calls the parent method
     *
     * @see SofortLibAbstract::sendRequest()
     */
    public function sendRequest()
    {
        $this->_rootTag = $this->_root . '_request';
        
        parent::sendRequest();
    }
    
    
    /**
     * Returns data from the response array.
     *
     * @param string $tag
     * @param string $parentTag
     * @param int|bool $n
     * @return bool|number|string
     */
    protected function _extractValue($tag, $parentTag = '', $n = false)
    {
        if (!count($this->_response)) {
            return false;
        }
        
        if ($parentTag === '') {
            return isset($this->_response[$tag]['@data']) ? $this->_response[$tag]['@data'] : false;
        } else {
            if ($n !== false && isset($this->_response[$parentTag][$tag][$n])) {
                //Special cases: reason both can have $n elements
                return isset($this->_response[$parentTag][$tag][$n]['@data']) ? $this->_response[$parentTag][$tag][$n]['@data'] : false;
            } else {
                //Some Data is nested (holder and sender data)
                //If $n was given but not found within the requested structure
                if ($n > 0) {
                    return false;
                }
                
                return isset($this->_response[$parentTag][$tag]['@data']) ? $this->_response[$parentTag][$tag]['@data'] : false;
            }
        }
    }
    
    
    /**
     * Parse the XML (override)
     *
     * @see SofortLibAbstract::_parse()
     * @return void
     */
    protected function _parse()
    {
        if (isset($this->_response[$this->_root . '_details'])) {
            $this->_response = $this->_response[$this->_root . '_details'];
        }
    }
    
    
    /**
     * Setter for the root-container
     *
     * @param string $root
     * @return PaycodeDetailsAbstract
     */
    protected function _setRoot($root)
    {
        $this->_root = $root;
        
        return $this;
    }
}