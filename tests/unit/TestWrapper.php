<?php
namespace Sofort\SofortLib;

abstract class TestWrapper extends \PHPUnit_Framework_TestCase
{
    protected static $user_id = '12345';
    
    protected static $project_id = '67890';
    
    protected static $apikey = 'n3v4zt98nu580v4590jm395vut34ßnv43354';
    
    protected static $configkey = '12345:67890:n3v4zt98nu580v4590jm395vut34ßnv43354';
    
    protected static $testapi_url = 'http://www.google.de/test/';
    
    //protected static $testapi_url = 'https://api.sofort.com/api/xml';
    
    protected static $ideal_userid = '12345';
    
    protected static $ideal_projectid = '67890';
    
    /**
     * your configkey or userid:projectid:apikey
     */
    protected static $ideal_configkey = '12345:67890:n3v4zt98nu580v4590jm395vut34ßnv43354';
    
    protected static $ideal_password = 'password';
    
    protected static $ideal_secret = 'secret_phrase';
    
    
    protected static function _getMethod($name, $classToTest)
    {
        $class = new \ReflectionClass($classToTest);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        
        return $method;
    }
    
    
    protected static function _getProperty($name, $classToTest)
    {
        $class = new \ReflectionClass($classToTest);
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        
        return $property;
    }
}