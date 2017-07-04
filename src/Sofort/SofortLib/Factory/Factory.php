<?php

namespace Sofort\SofortLib\Factory;

use Sofort\SofortLib\DataHandler\XmlDataHandler;
use Sofort\SofortLib\Http\HttpCurl;
use Sofort\SofortLib\Http\HttpSocket;
use Sofort\SofortLib\Logger\FileLogger;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Sofort Library Factory
 */
class Factory
{
    
    /**
     * Defines and includes the dataHandler
     *
     * @param string $configKey
     * @return XmlDataHandler
     */
    static public function getDataHandler($configKey)
    {
        return new XmlDataHandler($configKey);
    }
    
    
    /**
     * Defines the http connection to be used
     *
     * @param string $data
     * @param string|bool $url
     * @param array|bool $headers
     * @return HttpCurl|HttpSocket
     */
    static public function getHttpConnection($data, $url = false, $headers = false)
    {
        if (function_exists('curl_init')) {
            return new HttpCurl($data, $url, $headers);
        } else {
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
        return new FileLogger();
    }
}