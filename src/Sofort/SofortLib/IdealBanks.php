<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * This class encapsulates retrieval of listed banks of the Netherlands
 */
class IdealBanks extends AbstractWrapper
{
    
    const IDEAL_BANKS_URL = 'https://www.sofort.com/payment/ideal/banks';
    
    /**
     * Array for the banks and Ids returned from the API
     *
     * @var array
     */
    protected $_banks = array();
    
    
    /**
     * Constructor for SofortLibIDealBanks
     *
     * @param string $configKey
     * @param string $apiUrl (optional)
     */
    public function __construct($configKey, $apiUrl = '')
    {
        $this->_rootTag = 'ideal';
        
        if ($apiUrl == '') {
            $apiUrl = (getenv('idealApiUrl') != '') ? getenv('idealApiUrl') . '/banks' : self::IDEAL_BANKS_URL;
        }
        
        parent::__construct($configKey, $apiUrl);
    }
    
    
    /**
     * Getter for bank list
     *
     * @return array
     */
    public function getBanks()
    {
        return $this->_banks;
    }
    
    
    /**
     * Parse the xml (override)
     *
     * @see SofortLib_Abstract::_parse()
     * @return void
     */
    protected function _parse()
    {
        if (isset($this->_response['ideal']['banks']['bank'][0]['code']['@data'])) {
            foreach ($this->_response['ideal']['banks']['bank'] as $key => $bank) {
                $this->_banks[$key]['code'] = $bank['code']['@data'];
                $this->_banks[$key]['name'] = $bank['name']['@data'];
            }
        }
    }
}