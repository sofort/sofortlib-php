<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * this class handles requests using the curl method
 */
class HttpCurl extends AbstractHttp
{
    
    /**
     * Send data to server with POST request
     *
     * @param string $data
     * @param string|bool $url (optional)
     * @param string|bool $headers (optional)
     * @return string
     */
    public function post($data, $url = false, $headers = false)
    {
        $this->connectionMethod = 'cURL';
        
        if ($url === false) {
            $url = $this->url;
        }
        
        if ($headers === false) {
            $headers = $this->headers;
        }
        
        $curlOpt = array();
        $headers[] = 'User-Agent: SofortLib-php/' . SOFORTLIB_VERSION . '-' . $this->connectionMethod;
        $curlOpt[CURLOPT_HTTPHEADER] = array_merge($headers, array('Expect:'));
        //print_r($curlOpt[CURLOPT_HTTPHEADER]); die();
        $curlOpt[CURLOPT_POST] = 1;
        $curlOpt[CURLOPT_HEADER] = false;
        
        if ($this->compression !== false) {
            $curlOpt[CURLOPT_ENCODING] = $this->compression;
        }
        
        $curlOpt[CURLOPT_TIMEOUT] = 15;
        
        if ($this->proxy) {
            $curlOpt[CURLOPT_PROXY] = $this->proxy;
        }
        
        $curlOpt[CURLOPT_POSTFIELDS] = $data;
        $curlOpt[CURLOPT_RETURNTRANSFER] = 1;
        $curlOpt[CURLOPT_SSL_VERIFYHOST] = 0;
        $curlOpt[CURLOPT_SSL_VERIFYPEER] = false;
        
        $return = $this->_curlRequest($url, $curlOpt);
        
        if ($this->error) {
            return $this->_xmlError('00' . $this->error, $this->_response);
        }
        
        return $return;
    }
    
    
    /**
     * Post data using curl
     *
     * @param string $url
     * @param array $curlOpt (optional)
     * @return string
     */
    protected function _curlRequest($url, $curlOpt = array())
    {
        $process = curl_init($url);
        
        foreach ($curlOpt as $curlKey => $curlValue) {
            curl_setopt($process, $curlKey, $curlValue);
        }
        
        $return = curl_exec($process);
        $this->info = curl_getinfo($process);
        $this->error = curl_error($process);
        $this->httpStatus = $this->info['http_code'];
        $this->_response = $return;
        curl_close($process);
        
        return $return;
    }
}