<?php

namespace Sofort\SofortLib;

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 *
 * File logger
 *
 * A basic implementation of logging mechanism intended for debugging
 */
class FileLogger extends AbstractLoggerHandler
{
    
    /**
     * File Handler
     *
     * @var resource $fp
     */
    public $fp = null;
    
    /**
     * Maximum size of a log file in Bytes
     *
     * @var int $maxFilesize
     */
    public $maxFilesize = 1048576;
    
    /**
     * Path to errors logfile
     *
     * @var string $_errorLogfilePath
     */
    protected $_errorLogfilePath = false;
    
    /**
     * Path to Logfile
     *
     * @var string $_logfilePath
     */
    protected $_logfilePath = false;
    
    /**
     * Path to warnings logfile
     *
     * @var string $_warningsLogfilePath
     */
    protected $_warningsLogfilePath = false;
    
    
    /**
     * Constructor
     * Setting the LogfilePaths
     *
     * @param string $path
     */
    public function __construct($path = '')
    {
        $srcDir = dirname(dirname(dirname(__FILE__)));
        
        $this->_logfilePath = ($path != '') ? $path : $srcDir . '/logs/log.txt';
        $this->_errorLogfilePath = $srcDir . '/logs/error_log.txt';
        $this->_warningsLogfilePath = $srcDir . '/logs/warning_log.txt';
    }
    
    
    /**
     * Setting a log entry
     *
     * @param string $message
     * @param string $log (default = 'log')
     * @return bool
     */
    public function log($message, $log = 'log')
    {
        return $this->_log($message, $log);
    }
    
    
    /**
     * Set the path of the logfile
     *
     * @param string $path
     * @return void
     */
    public function setLogfilePath($path)
    {
        $this->_logfilePath = $path;
    }
    
    
    /**
     * Logs $msg to a file which path is being set by it's unified resource locator
     *
     * @param string $message
     * @param string $log (default = 'log')
     * @return bool
     */
    protected function _log($message, $log = 'log')
    {
        switch ($log) {
            case 'error':
                $file = $this->_errorLogfilePath;
                break;
            case 'warning':
                $file = $this->_warningsLogfilePath;
                break;
            default:
            case 'log':
                $file = $this->_logfilePath;
        }
        
        if (!is_file($file)) {
            $this->fp = fopen($file, 'w');
            fclose($this->fp);
        }
        
        if (is_writable($file)) {
            if ($log == 'log' && $this->_logRotate()) {
                $this->fp = fopen($file, 'w');
                fclose($this->fp);
            }
            
            $this->fp = fopen($file, 'a');
            fwrite($this->fp, '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n");
            fclose($this->fp);
            
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Copy the content of the logfile to a backup file if file size got too large
     * Put the old log file into a tarball for later reference
     *
     * @return bool
     */
    protected function _logRotate()
    {
        if (!is_writable($this->_logfilePath)) {
            return false;
        }
        
        $date = date('Y-m-d_h-i-s', time());
        
        if (file_exists($this->_logfilePath)) {
            if ($this->fp != null
                && filesize($this->_logfilePath) != false
                && filesize($this->_logfilePath) >= $this->maxFilesize
            ) {
                $oldUri = $this->_logfilePath;
                // file ending
                $ending = $ext = pathinfo($oldUri, PATHINFO_EXTENSION);
                $newUri = dirname($oldUri) . '/log_' . $date . '.' . $ending;
                rename($oldUri, $newUri);
                
                if (file_exists($oldUri)) {
                    unlink($oldUri);
                }
                
                return true;
            }
        }
        
        return false;
    }
}