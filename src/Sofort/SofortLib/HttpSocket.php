<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * this class handles requests using the socket method
 */
class HttpSocket extends AbstractHttp
{
    
    /**
     * @var string Scheme
     */
    protected $scheme = 'https';
    
    
    /**
     * Send data to server with POST request
     *
     * @param $data
     * @param string $url
     * @param bool $useHeaders
     * @return string
     */
    public function post($data, $url = null, $useHeaders = false)
    {
        $this->connectionMethod = 'Socket';
        
        if ($url === null) {
            $url = $this->url;
        }
        
        if (!$useHeaders) {
            $headers = $this->headers;
        } else {
            $headers = array();
        }
        
        $headers[] = 'User-Agent: SofortLib-php/' . SOFORTLIB_VERSION . '-' . $this->connectionMethod;
        $uri = parse_url($url);
        // set a fallback to connection via HTTPS
        $this->scheme = (isset($uri['scheme'])) ? $uri['scheme'] : 'https';
        $post = (isset($uri['path'])) ? 'POST ' . $uri['path'] . ' HTTP/1.1' . "\r\n" : '';
        $host = (isset($uri['host'])) ? 'HOST: ' . $uri['host'] . "\r\n" : '';
        $connection = 'Connection: close' . "\r\n";
        $contentLength = 'Content-Length: ' . strlen($data) . "\r\n";
        $out = $post . $host . $connection . $contentLength;
        
        foreach ($headers as $header) {
            $out .= $header . "\r\n";
        }
        
        $out .= "\r\n" . $data;
        $return = $this->_socketRequest($uri, $out);
        
        if ($this->error) {
            return $this->_xmlError('00' . $this->error, $this->_response);
        }
        
        preg_match('#^(.+?)\r\n\r\n(.*)#ms', $return, $body);
        
        //get status code
        preg_match('#HTTP/1.*([0-9]{3}).*#i', $body[1], $status);
        $this->info['http_code'] = $status[1];
        $this->httpStatus = $status[1];
        
        return $body[2];
    }
    
    
    /**
     * This is a fallback with fsockopen if curl is not activated
     * we still need openssl and ssl wrapper support (PHP >= 4.3.0)
     *
     * @param string $uri
     * @param string $out
     * @return string
     */
    protected function _socketRequest($uri, $out)
    {
        //connect to webservice
        $ssl = ($this->scheme === 'https') ? 'ssl://' : '';
        $port = ($this->scheme === 'http') ? 80 : 443;
        
        if (!$fp = fsockopen($ssl . $uri['host'], $port, $errno, $errstr, 15)) {
            $this->error = 'fsockopen() failed, enable ssl and curl: ' . $errno . ' ' . $errstr;
            
            return false;
        }
        
        //send data
        stream_set_timeout($fp, 15);
        fwrite($fp, $out);
        
        //read response
        $return = '';
        
        while (!feof($fp)) {
            $return .= fgets($fp, 512);
        }
        
        fclose($fp);
        
        return $return;
    }
}