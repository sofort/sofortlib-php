<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Abstract Paycode Class
 */
abstract class PaycodeAbstract extends Multipay
{
    
    /**
     * Container for the Bill/Paycode in the response
     *
     * @var string
     */
    protected $_code;
    
    /**
     * Codetype
     *
     * @var string
     */
    protected $_codetype = 'pay';
    
    /**
     * Container for the URL with the Bill/Paycode
     *
     * @var string (URL)
     */
    protected $_codeUrl;
    
    /**
     * Root tag for the XML to be rendered
     *
     * @var string
     */
    protected $_rootTag = 'paycode';
    
    
    /**
     * Getter for the Bill/Paycode in the response
     *
     * @return string
     */
    public function getCode()
    {
        $this->_code = isset($this->_response['new_' . $this->_codetype . 'code'][$this->_codetype . 'code']['@data'])
            ? $this->_response['new_' . $this->_codetype . 'code'][$this->_codetype . 'code']['@data']
            : false;
        
        return $this->_code;
    }
    
    
    /**
     * Getter for the Bill/Paycode URL in the response
     *
     * @return string
     */
    public function getCodeUrl()
    {
        $this->_codeUrl = isset($this->_response['new_' . $this->_codetype . 'code'][$this->_codetype . 'code_url']['@data'])
            ? $this->_response['new_' . $this->_codetype . 'code'][$this->_codetype . 'code_url']['@data']
            : false;
        
        return $this->_codeUrl;
    }
    
    
    /**
     * Setter for the end date (Bill/Paycode ist valid until that date)
     *
     * @param string $date YYYY-MM-DD hh:mm:ss
     * @return PaycodeAbstract
     */
    public function setEndDate($date)
    {
        $this->_parameters['end_date'] = $date;
        
        return $this;
    }
    
    
    /**
     * Setter for the senders bank code
     *
     * @param string $bank_code
     * @return PaycodeAbstract
     */
    public function setSenderBankCode($bank_code)
    {
        $this->_parameters['sender']['bank_code'] = $bank_code;
        
        return $this;
    }
    
    
    /**
     * Setter for the start date (Bill/Paycode ist valid from that date)
     *
     * @param string $date YYYY-MM-DD hh:mm:ss
     * @return PaycodeAbstract
     */
    public function setStartDate($date)
    {
        $this->_parameters['start_date'] = $date;
        
        return $this;
    }
}