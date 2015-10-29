<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * Class for refunds
 */
class Refund extends Multipay
{
    
    /**
     * API Version
     *
     * @var string
     */
    protected $_apiVersion = '3.0';
    
    /**
     * Refund count
     *
     * @var int
     */
    protected $_refund_count = 0;
    
    /**
     * Root Tag for the XML to be rendered
     *
     * @var string
     */
    protected $_rootTag = 'refunds';
    
    
    /**
     * Add a new refund to this message
     *
     * @param string $transaction transaction id of transfer you want to refund
     * @param float $amount amount of money to refund, less or equal to amount of original transfer
     * @param string $comment (optional) comment that will be displayed in admin-menu later
     * @return Refund
     */
    public function addRefund($transaction, $amount, $comment = '')
    {
        $this->_parameters['refund'][$this->_refund_count] = array(
            'transaction' => $transaction,
            'amount' => $amount,
            'comment' => $comment,
        );
        $this->_refund_count++;
        
        return $this;
    }
    
    
    /**
     * Getter for amounts
     *
     * @param int $i (default 0)
     * @return bool|double
     */
    public function getAmount($i = 0)
    {
        if ($this->_check_refund($i) && isset($this->_response['refunds']['refund'][$i]['amount'])) {
            return $this->_response['refunds']['refund'][$i]['amount']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for comments
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getComment($i = 0)
    {
        if ($this->_check_refund($i) && isset($this->_response['refunds']['refund'][$i]['comment'])) {
            return $this->_response['refunds']['refund'][$i]['comment']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for DTA
     *
     * @return bool|string
     */
    public function getDta()
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['dta'])) {
            return $this->_response['refunds']['dta']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Pain
     *
     * @return bool|string
     */
    public function getPain()
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['pain'])) {
            return $this->_response['refunds']['pain']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for partial refunds id
     *
     * @param int $i
     * @return bool|string
     */
    public function getPartialRefundId($i = 0)
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['refund'])) {
            if (isset($this->_response['refunds']['refund'][$i]) && isset($this->_response['refunds']['refund'][$i]['partial_refund_id'])) {
                return $this->_response['refunds']['refund'][$i]['partial_refund_id']['@data'];
            }
        }
        
        return false;
    }
    
    
    /**
     * Getter for the refunds reason.
     *
     * @param int $i (default 0)
     * @param string $reason either 'reason_1' or 'reason_2'
     * @return bool|string
     */
    public function getReason($i = 0, $reason = 'reason_1')
    {
        if (!in_array($reason, array('reason_1', 'reason_2'))) {
            return false;
        }
        
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['refund'])) {
            if (isset($this->_response['refunds']['refund'][$i]) && isset($this->_response['refunds']['refund'][$i][$reason])) {
                return $this->_response['refunds']['refund'][$i][$reason]['@data'];
            }
        }
        
        return false;
    }
    
    
    /**
     * Getter for refund's errors
     *
     * @param int $i (default 0)
     * @return bool|array
     */
    public function getRefundError($i = 0)
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['refund'])) {
            if (isset($this->_response['refunds']['refund'][$i]) && isset($this->_response['refunds']['refund'][$i]['errors'])) {
                $errorBlock = array();
                
                foreach ($this->_response['refunds']['refund'][$i]['errors']['error'] as $error) {
                    $errorBlock[] = $this->_getErrorBlock($error);
                }
                
                return parent::getError('all', array($errorBlock));
            }
        }
        
        return false;
    }
    
    
    /**
     * Getter for Recipient Bank Name
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getRecipientBankName($i = 0)
    {
        if ($this->_check_recipient($i) && isset($this->_response['refunds']['refund'][$i]['recipient']['bank_name'])) {
            return $this->_response['refunds']['refund'][$i]['recipient']['bank_name']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Recipient Bic
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getRecipientBic($i = 0)
    {
        if ($this->_check_recipient($i) && isset($this->_response['refunds']['refund'][$i]['recipient']['bic'])) {
            return $this->_response['refunds']['refund'][$i]['recipient']['bic']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Recipient Holder
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getRecipientHolder($i = 0)
    {
        if ($this->_check_recipient($i) && isset($this->_response['refunds']['refund'][$i]['recipient']['holder'])) {
            return $this->_response['refunds']['refund'][$i]['recipient']['holder']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Recipient Iban
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getRecipientIban($i = 0)
    {
        if ($this->_check_recipient($i) && isset($this->_response['refunds']['refund'][$i]['recipient']['iban'])) {
            return $this->_response['refunds']['refund'][$i]['recipient']['iban']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Sender (Bic)
     *
     * @return bool|string
     */
    public function getSenderBic()
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['sender']) && isset($this->_response['refunds']['sender']['bic'])) {
            return $this->_response['refunds']['sender']['bic']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Sender (Holder)
     *
     * @return bool|string
     */
    public function getSenderHolder()
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['sender']) && isset($this->_response['refunds']['sender']['holder'])) {
            return $this->_response['refunds']['sender']['holder']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for Sender (Iban)
     *
     * @return bool|string
     */
    public function getSenderIban()
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['sender']) && isset($this->_response['refunds']['sender']['iban'])) {
            return $this->_response['refunds']['sender']['iban']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for statuses
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getStatus($i = 0)
    {
        if ($this->_check_refund($i) && isset($this->_response['refunds']['refund'][$i]['status'])) {
            return $this->_response['refunds']['refund'][$i]['status']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for refunds time
     *
     * @param int $i
     * @return bool|string
     */
    public function getTime($i = 0)
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['refund'])) {
            if (isset($this->_response['refunds']['refund'][$i]) && isset($this->_response['refunds']['refund'][$i]['time'])) {
                return $this->_response['refunds']['refund'][$i]['time']['@data'];
            }
        }
        
        return false;
    }
    
    
    /**
     * Getter for refund's title
     *
     * @return bool|string
     */
    public function getTitle()
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['title'])) {
            return $this->_response['refunds']['title']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Getter for transactions
     *
     * @param int $i (default 0)
     * @return bool|string
     */
    public function getTransactionId($i = 0)
    {
        if ($this->_check_refund($i) && isset($this->_response['refunds']['refund'][$i]['transaction'])) {
            return $this->_response['refunds']['refund'][$i]['transaction']['@data'];
        }
        
        return false;
    }
    
    
    /**
     * Has an error occurred for refund
     *
     * @param int $i (default 0)
     * @return bool
     */
    public function isRefundError($i = 0)
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['refund'])) {
            if (isset($this->_response['refunds']['refund'][$i]) && isset($this->_response['refunds']['refund'][$i]['comment'])) {
                return $this->_response['refunds']['refund'][$i]['status']['@data'] == 'error';
            }
        }
        
        return false;
    }
    
    
    /**
     * Setter for the partial refund Id. Has to been added after relating addRefund
     *
     * @param $partialRefundId
     * @return Refund $this
     */
    public function setPartialRefundId($partialRefundId)
    {
        $this->_parameters['refund'][$this->_refund_count - 1]['partial_refund_id'] = $partialRefundId;
        
        return $this;
    }
    
    
    /**
     * Setter for the refunds reason. Has to been added after relating addRefund
     *
     * Overwrites parent-method
     *
     * @param string $reason_1
     * @param string $reason_2
     * @param string $productCode (unused in this implementation)
     * 
     * @see SofortLibMultipay::setReason()
     * @return Refund $this
     */
    public function setReason($reason_1, $reason_2 = '', $productCode = null)
    {
        $this->_parameters['refund'][$this->_refund_count - 1]['reason_1'] = $reason_1;
        
        if ($reason_2 != '') {
            $this->_parameters['refund'][$this->_refund_count - 1]['reason_2'] = $reason_2;
        }
        
        return $this;
    }
    
    
    /**
     * Setter for title
     *
     * @param string $title
     * @return Refund $this
     */
    public function setTitle($title)
    {
        $this->_parameters['title'] = $title;
        
        return $this;
    }
    
    
    /**
     * Checks if recipient is set in refund with given number
     *
     * @param int $i
     * @return bool
     */
    protected function _check_recipient($i = 0)
    {
        if ($this->_check_refund($i) && isset($this->_response['refunds']['refund'][$i]['recipient'])) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Checks if refund with given number is set
     *
     * @param int $i
     * @return bool
     */
    protected function _check_refund($i = 0)
    {
        if (isset($this->_response['refunds']) && isset($this->_response['refunds']['refund']) && isset($this->_response['refunds']['refund'][$i])) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Handle Errors occurred
     *
     * @return void
     */
    protected function _handleErrors()
    {
        if (isset($this->_response['refunds'])) {
            if (!isset($this->_response['refunds']['refund'][0])) {
                $tmp = $this->_response['refunds']['refund'];
                unset($this->_response['refunds']['refund']);
                $this->_response['refunds']['refund'][] = $tmp;
            }
            
            foreach ($this->_response['refunds']['refund'] as $response) {
                //handle errors
                if (isset($response['errors']['error'])) {
                    if (!isset($response['errors']['error'][0])) {
                        $tmp = $response['errors']['error'];
                        unset($response['errors']['error']);
                        $response['errors']['error'][0] = $tmp;
                    }
                    
                    foreach ($response['errors']['error'] as $error) {
                        $this->errors['global'][] = $this->_getErrorBlock($error);
                    }
                }
            }
        }
    }
}