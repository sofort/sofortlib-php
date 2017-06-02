<?php

namespace Sofort\SofortLib;

/**
 * SofortLibPHP version - Constant
 */
if (!defined('SOFORTLIB_VERSION')) {
    define('SOFORTLIB_VERSION', '3.0.0');
}

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Base class for SOFORT XML-Api
 *
 * This class implements basic http authentication and an xml-parser for parsing response messages
 *
 * Requires libcurl and openssl
 */
abstract class AbstractWrapper
{
    
    /**
     * API-URL
     */
    CONST GATEWAY_URL = "https://api.sofort.com/api/xml";
    
    /**
     * Define if logging is en/disabled
     *
     * @var bool
     */
    public $enableLogging = false;
    
    /**
     * Array for the errors that occurred
     *
     * @var array
     */
    public $errors = array();
    
    /**
     * Array for the warnings that occurred
     *
     * @var array
     */
    public $warnings = array();
    
    protected $_apiVersion = '1.0';
    
    /**
     * API-Key as provided in user account on sofort.com
     *
     * @var string
     */
    protected $_apiKey = '';
    
    /**
     * Complete config-key as provided in user account on sofort.com
     *
     * @var string
     */
    protected $_configKey = '';
    
    /**
     * Object for the data handler (usually XML-data handler)
     *
     * @var AbstractDataHandler
     */
    protected $_DataHandler = null;
    
    /**
     * Object for the logger
     *
     * @var AbstractLoggerHandler
     */
    protected $_Logger = null;
    
    /**
     * Array, that contains data and structure which will be send to the API (normally as XML)
     *
     * @var array
     */
    protected $_parameters = array();
    
    /**
     * Contains the allowed products
     *
     * @var array
     */
    protected $_products = array('global', 'su');
    
    /**
     * Project-ID from sofort.com
     *
     * @var string
     */
    protected $_projectId = '';
    
    /**
     * Contains the request data, that has been sent to the API
     *
     * @var array
     */
    protected $_request;
    
    /**
     * Provides the parsed response.
     *
     * @var array
     */
    protected $_response;
    
    /**
     * Defines the used part of the API
     *
     * @var string
     */
    protected $_rootTag = '';
    
    /**
     * User-ID from sofort.com
     *
     * @var string
     */
    protected $_userId = '';
    
    /**
     * @var bool
     */
    protected $_validateOnly = false;
    
    
    public function __construct($configKey, $apiUrl = '')
    {
        $this->setConfigKey($configKey);
        
        if ($apiUrl == '') {
            $apiUrl = (getenv('sofortApiUrl') != '') ? getenv('sofortApiUrl') : self::GATEWAY_URL;
        }
        
        $SofortLibHttp = Factory::getHttpConnection($apiUrl);
        $XmlDataHandler = Factory::getDataHandler($configKey);
        $this->setDataHandler($XmlDataHandler);
        $FileLogger = Factory::getLogger();
        $this->setLogger($FileLogger);
        $this->_DataHandler->setConnection($SofortLibHttp);
        $this->enableLogging = (getenv('sofortDebug') == 'true') ? true : false;
    }
    
    
    /**
     * Getter for configKey
     *
     * @return string
     */
    public function getConfigKey()
    {
        return $this->_configKey;
    }
    
    
    /**
     * Preparing array for request
     *
     * @return array
     */
    public function getData()
    {
        if (in_array($this->_rootTag, array('multipay', 'paycode', 'billcode'))) {
            $this->_parameters['project_id'] = $this->_projectId;
        }
        
        $requestData[$this->_rootTag] = $this->_parameters;
        $requestData = $this->_prepareRootTag($requestData);
        
        return $requestData;
    }
    
    
    /**
     * Getter for the dataHandler
     *
     * @return AbstractDataHandler|null
     */
    public function getDataHandler()
    {
        return $this->_DataHandler;
    }
    
    
    /**
     * Returns one error message
     *
     * @see getErrors() for more detailed errors
     * @param string $paymentMethod - 'all', 'sr', 'su' (default "all")
     * @param array $message (optional) response array
     * @return string errormessage ELSE false
     */
    public function getError($paymentMethod = 'all', $message = array())
    {
        if (empty($message)) {
            $message = $this->errors;
        }
        
        if (!in_array($paymentMethod, $this->_products)) {
            $paymentMethod = 'all';
        }
        
        if (is_array($message) && !empty($message)) {
            foreach ($message as $key => $error) {
                $errorIsArrayAndNotEmpty = is_array($error) && !empty($error);
                
                if ($this->_getPaymentMethodAllPmGlobal($paymentMethod, $key) && $errorIsArrayAndNotEmpty) {
                    return 'Error: ' . $error[0]['code'] . ':' . $error[0]['message'];
                }
            }
        }
        
        return false;
    }
    
    
    /**
     * Getter for errors
     *
     * @param string $paymentMethod - 'all', 'sr', 'su' (default "all")
     * @param array $message (optional) response array
     * @return array (empty array if no error exist ELSE array with error-codes and error-messages)
     */
    public function getErrors($paymentMethod = 'all', $message = array())
    {
        if (empty($message)) {
            $message = $this->handleErrors($this->errors);
        }
        
        if (!$this->isError($paymentMethod, $message)) {
            return array();
        }
        
        $supportedPaymentMethods = $this->_products;
        
        if (!in_array($paymentMethod, $supportedPaymentMethods)) {
            $paymentMethod = 'all';
        }
        
        $returnArray = array();
        
        // return global + selected payment method
        foreach ($supportedPaymentMethods as $pm) {
            if ($this->_getPaymentMethodAllPmGlobal($paymentMethod, $pm) && array_key_exists($pm, $message)) {
                $returnArray = array_merge($returnArray, $message[$pm]);
            }
        }
        
        return $returnArray;
    }
    
    /**
     * Get all errors in a string
     *
     * @param string $paymentMethod - 'all', 'sr', 'su' (default "all")
     * @param array $message (optional) response array
     * @return string  A string representation of the errors array.
     * 
     */
    public function getErrorsString($paymentMethod = 'all', $message = array())
    {
        $errors = $this->getErrors($paymentMethod, $message);
        $strings = array();
        
        foreach ($errors as $error) {
            $strings[] = 'Error: ' . $error['code'] . ':' . $error['message'] . '.';
        }
        
        return implode(' ', $strings);
    }
    
    
    /**
     * Getter for logHandler
     *
     * @return AbstractLoggerHandler
     */
    public function getLogger()
    {
        return $this->_Logger;
    }
    
    
    /**
     * Getter for parameter-array
     *
     * @return mixed
     */
    public function getParameters()
    {
        return $this->_parameters;
    }
    
    
    /**
     * Getter for the raw request data
     *
     * @return mixed
     */
    public function getRawRequest()
    {
        return $this->_DataHandler->getRawRequest();
    }
    
    
    /**
     * Getter for the raw response data
     *
     * @return mixed
     */
    public function getRawResponse()
    {
        return $this->_DataHandler->getRawResponse();
    }
    
    
    /**
     * Getter for the request data
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
     * @return array
     */
    public function getResponse()
    {
        return $this->_response;
    }
    
    
    /**
     * Getter for warnings
     *
     * @param string $paymentMethod - 'all', 'su' (default "all")
     * @param array $message (optional) response array
     * @return array (empty array if no warnings exists ELSE array with warning-codes and warning-messages)
     */
    public function getWarnings($paymentMethod = 'all', $message = array())
    {
        if (empty($message)) {
            $message = $this->warnings;
        }
        
        $supportedPaymentMethods = $this->_products;
        
        if (!in_array($paymentMethod, $supportedPaymentMethods)) {
            $paymentMethod = 'all';
        }
        
        $returnArray = array();
        
        // return global + selected payment method
        foreach ($supportedPaymentMethods as $pm) {
            if (($paymentMethod == 'all' || $pm == 'global' || $paymentMethod == $pm) && array_key_exists($pm,
                    $message)
            ) {
                $returnArray = array_merge($returnArray, $message[$pm]);
            }
        }
        
        return $returnArray;
    }
    
    
    /**
     * Alter error array and set error message and error code together as one
     *
     * @param array $errors
     * @return array (empty array if no error exist ELSE array with error-codes and error-messages)
     */
    public function handleErrors($errors)
    {
        $errorKeys = array_keys($errors);
        
        foreach ($errorKeys as $errorKey) {
            foreach ($errors[$errorKey] as &$partialError) {
                if (!empty($partialError['field']) && $partialError['field'] !== '') {
                    $partialError['code'] .= '.' . $partialError['field'];
                }
            };
        }
        
        return $errors;
    }
    
    
    /**
     * checks (response)-array for error
     *
     * @param string $paymentMethod - 'all', 'su' (if unknown then it uses "all")
     * @param array $message (optional) response array
     * @return bool true if errors found (in given payment-method or in 'global') ELSE false
     */
    public function isError($paymentMethod = 'all', $message = array())
    {
        if (empty($message)) {
            $message = $this->errors;
        }
        
        if (!in_array($paymentMethod, $this->_products)) {
            $paymentMethod = 'all';
        }
        
        if ($paymentMethod == 'all') {
            return $this->_isErrorWarning($message);
        } else {
            //paymentMethod-specific search
            if (is_array($message)) {
                return $this->_getPaymentSpecificError($paymentMethod, $message);
            }
        }
        
        return false;
    }
    
    
    /**
     * Checks (response)-array for warnings
     *
     * @param string $paymentMethod - 'all', 'su' (default "all")
     * @param array $message (optional) response array
     * @return bool true if warnings found ELSE false
     */
    public function isWarning($paymentMethod = 'all', $message = array())
    {
        if (empty($message)) {
            $message = $this->warnings;
        }
        
        if (!in_array($paymentMethod, $this->_products)) {
            $paymentMethod = 'all';
        }
        
        if ($paymentMethod == 'all') {
            return $this->_isErrorWarning($message);
        } else {
            if (is_array($message)) {
                if (!empty($message[$paymentMethod]) || !empty($message['global'])) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    
    /**
     * Log the given string into log.txt
     * use $this->enableLog(); to enable logging before!
     *
     * @param string $message
     * @return void
     */
    public function log($message)
    {
        if ($this->enableLogging) {
            $this->_Logger->log($message, 'log');
        }
    }
    
    
    /**
     * Log the given string into error_log.txt
     * use $this->enableLog(); to enable logging before!
     *
     * @param string $message
     * @return void
     */
    public function logError($message)
    {
        if ($this->enableLogging) {
            $this->_Logger->log($message, 'error');
        }
    }
    
    
    /**
     * Log the given string into warning_log.txt
     * use $this->enableLog(); to enable logging before!
     *
     * @param string $message
     * @return void
     */
    public function logWarning($message)
    {
        if ($this->enableLogging) {
            $this->_Logger->log($message, 'warning');
        }
    }
    
    
    /**
     * SendRequest sends request (array) to the dataHandler and gets response (array)
     *
     * @return void
     */
    public function sendRequest()
    {
        $this->_request = $this->getData();
        $this->_DataHandler->handle($this->_request);
        $getRequest = $this->_DataHandler->getRequest();
        
        if (is_array($getRequest)) {
            $getRequest = implode($getRequest);
        }
        
        $this->log(' Request -> ' . $getRequest);
        $this->_response = $this->_DataHandler->getResponse();
        $getRawResponse = $this->_DataHandler->getRawResponse();
        
        $this->log(' Response -> ' . $getRawResponse);
        $this->_parse();
        $this->_handleErrors();
    }
    
    
    /**
     * The customer will be redirected to this url if he uses the abort link on the payment form, should redirect
     * him back to his cart or to the payment selection page
     *
     * @param string $abortUrl url for aborting the transaction
     * @return AbstractWrapper $this
     */
    public function setAbortUrl($abortUrl)
    {
        $this->_parameters['abort_url'] = $abortUrl;
        
        return $this;
    }
    
    
    /**
     * Sets the version tag, appended to the root tag as attribute
     *
     * @param string $apiVersion
     * @return AbstractWrapper $this
     */
    public function setApiVersion($apiVersion)
    {
        $this->_apiVersion = $apiVersion;
        
        return $this;
    }
    
    
    /**
     * Setter for ConfigKey and parsing ConfigKey into userId, projectId and apiKey
     *
     * @param string $configKey
     * @return AbstractWrapper $this
     */
    public function setConfigKey($configKey)
    {
        $this->_configKey = $configKey;
        list($this->_userId, $this->_projectId, $this->_apiKey) = explode(':', $configKey);
        
        return $this;
    }
    
    
    /**
     * Setter for currency eg. EUR
     *
     * @param string $currency
     * @return AbstractWrapper $this
     */
    public function setCurrencyCode($currency)
    {
        $this->_parameters['currency_code'] = $currency;
        
        return $this;
    }
    
    
    /**
     * Setter for the dataHandler
     *
     * @param AbstractDataHandler $Handler
     * @return AbstractWrapper $this
     */
    public function setDataHandler(AbstractDataHandler $Handler)
    {
        $this->_DataHandler = $Handler;
        $this->_DataHandler->setUserId($this->_userId);
        $this->_DataHandler->setProjectId($this->_projectId);
        $this->_DataHandler->setApiKey($this->_apiKey);
        
        return $this;
    }
    
    
    /**
     * Set errors
     * later use getError(), getErrors() or isError() to retrieve them
     *
     * @param string $message - detailed information about the error
     * @param string $pos - Position in the errors-array, must be one of: 'global', 'sr', 'su' (default global)
     * @param string $errorCode - a number or string to specify the errors in the module (default -1)
     * @param string $field (optional) - if $errorCode deals with a field
     * @return void
     */
    public function setError($message, $pos = 'global', $errorCode = '-1', $field = '')
    {
        $supportedErrorsPos = array('global', 'sr', 'su');
        
        if (!in_array($pos, $supportedErrorsPos)) {
            $pos = 'global';
        }
        
        if (!isset($this->errors[$pos])) {
            $this->errors[$pos] = array();
        }
        
        $error = array('code' => $errorCode, 'message' => $message, 'field' => $field);
        $this->errors[$pos][] = $error;
    }
    
    
    /**
     * Set logging disabled
     *
     * @return AbstractWrapper $this
     */
    public function setLogDisabled()
    {
        $this->enableLogging = false;
        
        return $this;
    }
    
    
    /**
     * Set logging enable
     *
     * @return AbstractWrapper $this
     */
    public function setLogEnabled()
    {
        $this->enableLogging = true;
        
        return $this;
    }
    
    
    /**
     * Setter for logHandler
     *
     * @param AbstractLoggerHandler $Logger
     * @return AbstractWrapper $this
     */
    public function setLogger(AbstractLoggerHandler $Logger)
    {
        $this->_Logger = $Logger;
        
        return $this;
    }
    
    
    /**
     * Sets the notification email-address and it's attributes
     *
     * @param string $notificationAddress
     * @param string $notifyOn Comma separated (notification on: loss|pending|received|refunded)
     * @return AbstractWrapper $this
     */
    public function setNotificationEmail($notificationAddress, $notifyOn = '')
    {
        return $this->_setNotification($notificationAddress, 'email', $notifyOn);
    }
    
    
    /**
     * Sets the notification URL and it's attributes
     *
     * @param string $notificationAddress
     * @param string $notifyOn Comma separated (notification on: loss|pending|received|refunded)
     * @return AbstractWrapper $this
     */
    public function setNotificationUrl($notificationAddress, $notifyOn = '')
    {
        return $this->_setNotification($notificationAddress, 'url', $notifyOn);
    }
    
    
    /**
     * Setter for parameter array
     *
     * @param array $parameters
     * @return AbstractWrapper $this
     */
    public function setParameters($parameters)
    {
        $this->_parameters = $parameters;
        
        return $this;
    }
    
    
    /**
     * Setter for redirecting the success link automatically
     *
     * @param bool $arg
     * @return AbstractWrapper $this
     */
    public function setSuccessLinkRedirect($arg)
    {
        $this->_parameters['success_link_redirect'] = $arg;
        
        return $this;
    }
    
    
    /**
     * The customer will be redirected to this url after a successful transaction, this should be a page where a short
     * confirmation is displayed
     *
     * @param string $successUrl the url after a successful transaction
     * @param bool $redirect (default true)
     * @return AbstractWrapper $this
     */
    public function setSuccessUrl($successUrl, $redirect = true)
    {
        $this->_parameters['success_url'] = $successUrl;
        $this->setSuccessLinkRedirect($redirect);
        
        return $this;
    }
    
    
    /**
     * If the customer takes too much time or if your timeout is set too short he will be redirected to this page
     *
     * @param string $timeoutUrl url
     * @return AbstractWrapper $this
     */
    public function setTimeoutUrl($timeoutUrl)
    {
        $this->_parameters['timeout_url'] = $timeoutUrl;
        
        return $this;
    }
    
    
    /**
     * Getter for error block
     *
     * @param array $error
     * @return array
     */
    protected function _getErrorBlock($error)
    {
        $newError['code'] = isset($error['code']['@data']) ? $error['code']['@data'] : '';
        $newError['message'] = isset($error['message']['@data']) ? $error['message']['@data'] : '';
        $newError['field'] = isset($error['field']['@data']) ? $error['field']['@data'] : '';
        
        return $newError;
    }
    
    
    /**
     * Handle errors and warnings which occurred
     *
     * @return void
     */
    protected function _handleErrors()
    {
        //handle errors
        if (isset($this->_response['errors']['error'])) {
            if (!isset($this->_response['errors']['error'][0])) {
                $this->errors['global'][] = $this->_getErrorBlock($this->_response['errors']['error']);
            } else {
                foreach ($this->_response['errors']['error'] as $error) {
                    $this->errors['global'][] = $this->_getErrorBlock($error);
                }
            }
        }
        
        //handle warnings
        if (isset($this->_response['new_transaction']['warnings']['warning'])) {
            if (!isset($this->_response['new_transaction']['warnings']['warning'][0])) {
                $this->warnings['global'][] = $this->_getErrorBlock($this->_response['new_transaction']['warnings']['warning']);
            } else {
                foreach ($this->_response['new_transaction']['warnings']['warning'] as $warning) {
                    $this->warnings['global'][] = $this->_getErrorBlock($warning);
                }
            }
        }
    }
    
    
    /**
     * Parse data received or being sent
     */
    protected function _parse()
    {
    }
    
    
    /**
     * Set the type of notification and the address where it should be sent to being sent to.
     *
     * @param string $notificationAddress email address or url
     * @param string $notificationType (url|email)
     * @param string $notifyOn Comma separated (notification on: loss|pending|received|refunded)
     * @return AbstractWrapper $this
     */
    protected function _setNotification($notificationAddress, $notificationType, $notifyOn = '')
    {
        if ($notifyOn) {
            $notifyOnArrayIn = explode(',', $notifyOn);
            $notifyOnDefault = array('loss', 'pending', 'received', 'refunded');
            $notifyOnArray = array();
            
            if (is_array($notifyOnArrayIn)) {
                foreach ($notifyOnArrayIn as $notifyStatus) {
                    if (in_array($notifyStatus, $notifyOnDefault)) {
                        $notifyOnArray[] = $notifyStatus;
                    }
                }
            }
            
            $notifyOn = array('notify_on' => implode(',', $notifyOnArray));
        }
        
        if (!$notifyOn) {
            $notification = array('@data' => $notificationAddress);
        } else {
            $notification = array('@data' => $notificationAddress, '@attributes' => $notifyOn);
        }
        
        $this->_parameters['notification_' . $notificationType . 's']['notification_' . $notificationType][] = $notification;
        
        return $this;
    }
    
    
    /**
     * Helper function to compare given and supported payment method
     *
     * @param string $paymentMethod
     * @param string $pm
     * @return bool
     */
    private function _getPaymentMethodAllPmGlobal($paymentMethod, $pm)
    {
        return $paymentMethod == 'all' || $pm == 'global' || $paymentMethod == $pm;
    }
    
    
    /**
     * checks (response)- for payment-specific error
     *
     * @param string $paymentMethod - 'all', 'su' (if unknown then it uses "all")
     * @param (optional) array $message response array
     * @return bool true if errors found (in given payment-method or in 'global') ELSE false
     */
    private function _getPaymentSpecificError($paymentMethod, $message)
    {
        $messagePaymentMethodSetNotEmpty = isset($message[$paymentMethod]) && !empty($message[$paymentMethod]);
        $messageGlobalSetNotEmpty = isset($message['global']) && !empty($message['global']);
        $messagePaymentMethodOrGlobalSetNotEmpty = $messagePaymentMethodSetNotEmpty || $messageGlobalSetNotEmpty;
        
        if ($messagePaymentMethodOrGlobalSetNotEmpty) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Helper to iterate through an array of error or warning messages to find out whether an error/warning occurred
     * or not.
     *
     * @param array $message
     * @return bool
     */
    private function _isErrorWarning($message)
    {
        if (is_array($message)) {
            foreach ($message as $errorWarning) {
                if (!empty($errorWarning)) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    
    /**
     * Prepare the root tag
     *
     * @param array $requestData
     * @return array
     */
    private function _prepareRootTag($requestData)
    {
        if ($this->_apiVersion) {
            $requestData[$this->_rootTag]['@attributes']['version'] = $this->_apiVersion;
        }
        
        if ($this->_validateOnly) {
            $requestData[$this->_rootTag]['@attributes']['validate_only'] = 'yes';
        }
        
        return $requestData;
    }
}
