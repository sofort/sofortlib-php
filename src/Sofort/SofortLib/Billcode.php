<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 */
class Billcode extends PaycodeAbstract
{
    
    protected $_codetype = 'bill';
    
    /**
     * Root Tag for the XML to be rendered
     *
     * @var string $_rootTag
     */
    protected $_rootTag = 'billcode';
    
    
    /**
     * wrapper to set the Project ID and to call the parent method (sendRequest)
     *
     * @return void
     */
    public function createBillcode()
    {
        $this->_parameters['project_id'] = $this->_projectId;
        parent::sendRequest();
    }
    
    
    /**
     * Wrapper to get the Billcode from the response
     *
     * @return string
     */
    public function getBillcode()
    {
        return parent::getCode();
    }
    
    
    /**
     * Wrapper to get the Billcode URL
     *
     * @return string
     */
    public function getBillcodeUrl()
    {
        return parent::getCodeUrl();
    }
    
    
    /**
     * AbortURL is not available in Billcode, Superclass' method will be overwritten
     *
     * @see SofortLibAbstract::setAbortUrl()
     * @param string $abortUrl
     *
     * @return Billcode
     */
    public function setAbortUrl($abortUrl = '')
    {
        return $this;
    }
    
    
    /**
     * SuccessURL is not available in Billcode, Superclass' method will be overwritten
     *
     * @see SofortLibAbstract::setSuccessUrl()
     * @param string $successUrl
     * @param bool $redirect
     * @return Billcode
     */
    public function setSuccessUrl($successUrl = '', $redirect = true)
    {
        return $this;
    }
    
    
    /**
     * TimeoutURL is not available in Billcode, Superclass' method will be overwritten
     *
     * @see SofortLibAbstract::setTimeoutUrl()
     * @param string $timeoutUrl
     * @return Billcode
     */
    public function setTimeoutUrl($timeoutUrl = '')
    {
        return $this;
    }
    
}