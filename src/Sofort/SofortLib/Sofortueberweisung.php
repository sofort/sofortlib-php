<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 */
class Sofortueberweisung extends Multipay
{
    
    /**
     * Constructor for Sofortueberweisung
     *
     * @param string $configKey
     * @return Sofortueberweisung
     */
    public function __construct($configKey)
    {
        parent::__construct($configKey);
        $this->_parameters['su'] = array();
    }
    
    
    /**
     * Setter for Customer Protection if possible for customers
     *
     * @param bool $customerProtection (default true)
     * @return Sofortueberweisung $this
     */
    public function setCustomerprotection($customerProtection = true)
    {
        if (!array_key_exists('su', $this->_parameters) || !is_array($this->_parameters['su'])) {
            $this->_parameters['su'] = array();
        }
        
        $this->_parameters['su']['customer_protection'] = $customerProtection ? 1 : 0;
        
        return $this;
    }
    
    
    /**
     * Handle Errors occurred
     *
     * @return void
     */
    protected function _handleErrors()
    {
        parent::_handleErrors();
        
        //handle errors
        if (isset($this->_response['errors']['su'])) {
            if (!isset($this->_response['errors']['su']['errors']['error'][0])) {
                $tmp = $this->_response['errors']['su']['errors']['error'];
                unset($this->_response['errors']['su']['errors']['error']);
                $this->_response['errors']['su']['errors']['error'][0] = $tmp;
            }
            
            foreach ($this->_response['errors']['su']['errors']['error'] as $error) {
                $this->errors['su'][] = $this->_getErrorBlock($error);
            }
        }
        
        //handle warnings
        if (isset($this->_response['new_transaction']['warnings']['su'])) {
            if (!isset($this->_response['new_transaction']['warnings']['su']['warnings']['warning'][0])) {
                $tmp = $this->_response['new_transaction']['warnings']['su']['warnings']['warning'];
                unset($this->_response['new_transaction']['warnings']['su']['warnings']['warning']);
                $this->_response['new_transaction']['warnings']['su']['warnings']['warning'][0] = $tmp;
            }
            
            foreach ($this->_response['new_transaction']['warnings']['su']['warnings']['warning'] as $warning) {
                $this->warnings['su'][] = $this->_getErrorBlock($warning);
            }
        }
    }
}