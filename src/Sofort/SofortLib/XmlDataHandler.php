<?php

namespace Sofort\SofortLib;

use Sofort\SofortLib\Xml\ArrayToXml;
use Sofort\SofortLib\Xml\XmlToArray;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Handler for XML Data
 */
class XmlDataHandler extends AbstractDataHandler
{
    
    /**
     * Should be moved to somewhere else (where it fits better)
     *
     * @param string $configKey
     */
    public function __construct($configKey)
    {
        parent::__construct($configKey);
    }
    
    
    /**
     * Preparing data and parsing result received
     *
     * @param array $data
     * @return void
     */
    public function handle($data)
    {
        $this->_request = ArrayToXml::render($data);
        $this->_rawRequest = $this->_request;
        $xmlResponse = self::sendMessage($this->_request);
        
        if (!in_array($this->getConnection()->getHttpStatusCode(), array('200', '301', '302'))) {
            $this->_response = array(
                'errors' => array(
                    'error' => array(
                        'code' => array('@data' => $this->getConnection()->getHttpStatusCode()),
                        'message' => array('@data' => $this->getConnection()->error)
                    )
                )
            );
        } else {
            try {
                $this->_response = XmlToArray::render($xmlResponse);
            } catch (\Exception $e) {
                $this->_response = array(
                    'errors' => array(
                        'error' => array(
                            'code' => array('@data' => '0999'),
                            'message' => array('@data' => $e->getMessage())
                        )
                    )
                );
            }
        }
        $this->_rawResponse = $xmlResponse;
    }
    
    
    /**
     * Sending data to connection and returning results
     *
     * @param string $data
     * @return string
     */
    public function sendMessage($data)
    {
        return $this->getConnection()->post($data);
    }
}