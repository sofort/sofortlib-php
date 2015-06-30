<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Sofort Library Factory
 */
class Factory
{
    
    /**
     * Defines and includes the DataHandler
     *
     * @param string $configKey
     * @return XmlDataHandler
     */
    static public function getDataHandler($configKey)
    {
        require_once(dirname(__FILE__) . '/XmlDataHandler.php');
        
        return new XmlDataHandler($configKey);
    }
    
    
    /**
     * Defines the Http Connection to be used
     *
     * @param string $data
     * @param string|bool $url
     * @param array|bool $headers
     * @return HttpCurl|HttpSocket
     */
    static public function getHttpConnection($data, $url = false, $headers = false)
    {
        if (function_exists('curl_init')) {
            require_once(dirname(__FILE__) . '/HttpCurl.php');
            
            return new HttpCurl($data, $url, $headers);
        } else {
            require_once(dirname(__FILE__) . '/HttpSocket.php');
            
            return new HttpSocket($data, $url, $headers);
        }
    }
    
    
    /**
     * Defines and includes the logger
     *
     * @return FileLogger
     */
    static public function getLogger()
    {
        require_once(dirname(__FILE__) . '/FileLogger.php');
        
        return new FileLogger();
    }
}