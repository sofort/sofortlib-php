<?php

namespace Sofort\SofortLib;

use Sofort\SofortLib\Xml\XmlToArray;

/**
 * @copyright 2010-2016 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * This class handles incoming notifications for sofortueberweisung and invoice
 */
class Notification
{
    
    /**
     * Array for the errors that occurred
     *
     * @var array
     */
    public $errors = array();
    
    /**
     * Container for the returned timestamp
     *
     * @var string
     */
    private $_time;
    
    /**
     * Container for the returned transaction-ID
     *
     * @var string
     */
    private $_transactionId = '';
    
    /**
     * Reads the input and tries to read the transaction-ID
     *
     * @param string $content XML-File Content
     * @return bool|string (transaction ID, when true)
     */
    public function getNotification($content)
    {
        try {
            $response = XmlToArray::render($content);
        } catch (\Exception $e) {
            $this->errors['error']['message'] = 'could not parse message';
            
            return false;
        }
        
        if (!isset($response['status_notification'])) {
            return false;
        }
        
        if (isset($response['status_notification']['transaction']['@data'])) {
            $this->_transactionId = $response['status_notification']['transaction']['@data'];
            
            if ($response['status_notification']['time']['@data']) {
                $this->_time = $response['status_notification']['time']['@data'];
            }
            
            return $this->_transactionId;
        } else {
            return false;
        }
    }
    
    
    /**
     * Getter for variable time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->_time;
    }
    
    
    /**
     * Getter for transaction
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->_transactionId;
    }
}