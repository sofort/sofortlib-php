<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 */
class BillcodeDetails extends PaycodeDetailsAbstract
{
    
    protected $_root = 'billcode';
    
    protected $_rootTag = 'billcode_request';
    
    
    /**
     * Returns the responses billcode
     *
     * @return mixed|bool
     */
    public function getBillcode()
    {
        return $this->_extractValue('billcode');
    }
    
    
    /**
     * Setter for the billcode of the request
     *
     * @param string $billcode
     * @return BillcodeDetails $this
     */
    public function setBillcode($billcode)
    {
        $this->_parameters['billcode'] = $billcode;
        
        return $this;
    }
}