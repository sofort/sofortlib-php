<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Abstract Data Handler
 *
 * Handles the SofortLibs data-input and output. At the moment this library only offers a XML-Handler, others
 * (i.e. JSON) are possible, too.
 */
abstract class AbstractDataHandler
{
    
    /**
     * API-Key as provided in user account on sofort.com
     *
     * @var string
     */
    protected $_apiKey = '';
    
    /**
     * Complete Config-Key as provided in user account on sofort.com
     *
     * @var string
     */
    protected $_configKey = '';
    
    /**
     * Object for the type of the connection, HTTP, others might follow
     *
     * @var AbstractHttp
     */
    protected $_Connection = null;    // http instance
    
    /**
     * Object for the logging.
     *
     * @var object
     */
    protected $_Logger = null;    // Logger instance
    
    /**
     * Project-ID from sofort.com
     *
     * @var string
     */
    protected $_projectId = '';
    
    /**
     * Contains the raw request data
     *
     * @var array, string
     */
    protected $_rawRequest = '';
    
    /**
     * Provides the naked response returned by the API or (if no answer was received) an Error Code.
     *
     * @var array, string
     */
    protected $_rawResponse = '';
    
    /**
     * Contains the request data, that has been sent to the API
     *
     * @var array
     */
    protected $_request = array();
    
    /**
     * Provides the parsed response.
     *
     * @var array
     */
    protected $_response = array();
    
    /**
     * User-ID from sofort.com
     *
     * @var string
     */
    protected $_userId = '';
    
    
    /**
     * Constructor for AbstractDataHandler
     *
     * @param string $configKey
     */
    public function __construct($configKey)
    {
        $this->setConfigKey($configKey);
    }
    
    
    /**
     * Getter for the apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->_apiKey;
    }
    
    
    /**
     * Returns the connection, normally a http instance
     *
     * @return AbstractHttp Object
     */
    public function getConnection()
    {
        return $this->_Connection;
    }
    
    
    /**
     * Getter for the projectId
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->_projectId;
    }
    
    
    /**
     * Getter for the raw request data
     *
     * @return string
     */
    public function getRawRequest()
    {
        return $this->_rawRequest;
    }
    
    
    /**
     * Getter for the raw response data
     *
     * @return string
     */
    public function getRawResponse()
    {
        return $this->_rawResponse;
    }
    
    
    /**
     * Getter for the request
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }
    
    
    /**
     * Getter for the response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->_response;
    }
    
    
    /**
     * Getter for the userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->_userId;
    }
    
    
    abstract function handle($data);
    
    
    abstract function sendMessage($data);
    
    
    /**
     * Setter for the apiKey
     *
     * @param string $apiKey
     * @return AbstractDataHandler $this
     */
    public function setApiKey($apiKey)
    {
        $this->_apiKey = $apiKey;
        
        return $this;
    }
    
    
    /**
     * Setting the configKey and extracting userId, projectId and apiKey from configKey
     *
     * @param string $configKey
     * @return AbstractDataHandler $this
     */
    public function setConfigKey($configKey)
    {
        $this->_configKey = $configKey;
        list($this->_userId, $this->_projectId, $this->_apiKey) = explode(':', $configKey);
        
        return $this;
    }
    
    
    /**
     * Setting the connection (standard: http instance) and the configkey
     *
     * @param string $Connection
     * @return AbstractDataHandler $this
     */
    public function setConnection($Connection)
    {
        $this->_Connection = $Connection;
        $this->_Connection->setConfigKey($this->_configKey);
        
        return $this;
    }
    
    
    /**
     * Setter for the projectId
     *
     * @param string $projectId
     * @return AbstractDataHandler $this
     */
    public function setProjectId($projectId)
    {
        $this->_projectId = $projectId;
        
        return $this;
    }
    
    
    /**
     * Setter for the userId
     *
     * @param string $userId
     * @return AbstractDataHandler $this
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
        
        return $this;
    }
}