<?php

namespace Sofort\SofortLib;

class AbstractHttpTest extends AbstractClassTest
{
    
    protected $_classToTest = 'Sofort\SofortLib\AbstractHttp';
    
    public function providerConstructor()
    {
        return array(
            array(array('http://www.test.de',),),
            array(array('http://www.test.de', true),),
            array(array('http://www.test.de', false),),
            array(array('http://www.test.de', true, 'someProxy'),),
            array(array('http://www.test.de', false, 'someProxy'),),
        );
    }
    
    
    public function providerGetHttpCode()
    {
        return array(
            array(
                array(4711, 'http://www.google.de', 'test',),
                array(
                    'code' => 4711,
                    'message' => '<errors><error><code>04711</code><message>Something went wrong, not handled httpStatus</message></error></errors>',
                    'response' => 'test'
                ),
            ),
            array(
                array(200, 'http://www.google.de', 'test',),
                array(
                    'code' => 200,
                    'message' => '<errors><error><code>0200</code><message>OK</message></error></errors>',
                    'response' => 'test'
                ),
            ),
            array(
                array(301, 'http://www.google.de', 'test',),
                array(
                    'code' => 301,
                    'message' => '<errors><error><code>0301</code><message>Redirected Request</message></error></errors>',
                    'response' => 'test'
                ),
            ),
            array(
                array(302, 'http://www.google.de', 'test',),
                array(
                    'code' => 302,
                    'message' => '<errors><error><code>0302</code><message>Redirected Request</message></error></errors>',
                    'response' => 'test'
                ),
            ),
            array(
                array(401, 'http://www.google.de', 'test',),
                array(
                    'code' => 401,
                    'message' => '<errors><error><code>0401</code><message>Unauthorized</message></error></errors>',
                    'response' => 'test'
                ),
            ),
            array(
                array(0, 'http://www.google.de', '',),
                array(
                    'code' => 404,
                    'message' => '<errors><error><code>0404</code><message>URL not found http://www.google.de</message></error></errors>',
                    'response' => ''
                ),
            ),
            array(
                array(404, 'http://www.google.de', '',),
                array(
                    'code' => 404,
                    'message' => '<errors><error><code>0404</code><message>URL not found http://www.google.de</message></error></errors>',
                    'response' => ''
                ),
            ),
            array(
                array(500, 'http://www.google.de', 'test',),
                array(
                    'code' => 500,
                    'message' => '<errors><error><code>0500</code><message>An error occurred</message></error></errors>',
                    'response' => 'test'
                ),
            ),
        );
    }
    
    
    public function providerGetHttpStatusCode()
    {
        return array(
            array(array(4711, 'http://www.google.de', 'test',), 4711,),
            array(array(200, 'http://www.google.de', 'test',), 200,),
            array(array(301, 'http://www.google.de', 'test',), 301,),
            array(array(302, 'http://www.google.de', 'test',), 302,),
            array(array(401, 'http://www.google.de', 'test',), 401,),
            array(array(0, 'http://www.google.de', '',), 404,),
            array(array(404, 'http://www.google.de', '',), 404,),
            array(array(500, 'http://www.google.de', 'test',), 500,),
        );
    }
    
    
    public function providerGetHttpStatusMessage()
    {
        return array(
            array(
                array(4711, 'http://www.google.de', 'test',),
                '<errors><error><code>04711</code><message>Something went wrong, not handled httpStatus</message></error></errors>',
            ),
            array(
                array(200, 'http://www.google.de', 'test',),
                '<errors><error><code>0200</code><message>OK</message></error></errors>',
            ),
            array(
                array(301, 'http://www.google.de', 'test',),
                '<errors><error><code>0301</code><message>Redirected Request</message></error></errors>',
            ),
            array(
                array(302, 'http://www.google.de', 'test',),
                '<errors><error><code>0302</code><message>Redirected Request</message></error></errors>',
            ),
            array(
                array(401, 'http://www.google.de', 'test',),
                '<errors><error><code>0401</code><message>Unauthorized</message></error></errors>',
            ),
            array(
                array(0, 'http://www.google.de', '',),
                '<errors><error><code>0404</code><message>URL not found http://www.google.de</message></error></errors>',
            ),
            array(
                array(404, 'http://www.google.de', '',),
                '<errors><error><code>0404</code><message>URL not found http://www.google.de</message></error></errors>',
            ),
            array(
                array(500, 'http://www.google.de', 'test',),
                '<errors><error><code>0500</code><message>An error occurred</message></error></errors>',
            ),
        );
    }
    
    
    public function providerGetInfo()
    {
        return array(
            array(array('test'), array('test'),),
            array(array('test', 'wusel',), array('test', 'wusel',),),
            array(array('http_code' => 'test', 'status' => 'wusel',), 'test', 'http_code'),
            array(array('http_code' => 'test', 'status' => 'wusel',), 'wusel', 'status'),
        );
    }
    
    
    /**
     * @dataProvider providerConstructor
     * @param array $provided
     */
    public function testConstructor($provided)
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass($provided);
        
        if (count($provided) == 3) {
            $this->assertEquals($provided[1], $Http->compression);
            $this->assertEquals($provided[2], $Http->proxy);
        } else {
            if (count($provided) == 2) {
                $this->assertEquals($provided[1], $Http->compression);
            }
        }
        
        $this->assertEquals($provided[0], $Http->url);
    }
    
    
    /**
     * @dataProvider providerGetHttpCode
     * @param array $provided
     * @param array $expected
     */
    public function testGetHttpCode($provided, $expected)
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass(array(self::$testapi_url));
        $Http->/** @var AbstractHttp $Http */
        httpStatus = $provided[0];
        $Http->url = $provided[1];
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($Http, $provided[2]);
        $this->assertEquals($expected, $Http->getHttpCode());
    }
    
    
    /**
     * @dataProvider providerGetHttpStatusCode
     * @param array $provided
     * @param string $expected
     */
    public function testGetHttpStatusCode($provided, $expected)
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass(array(self::$testapi_url));
        $Http->httpStatus = $provided[0];
        $Http->url = $provided[1];
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($Http, $provided[2]);
        $this->assertEquals($expected, $Http->getHttpStatusCode());
    }
    
    
    /**
     * @dataProvider providerGetHttpStatusMessage
     * @param array $provided
     * @param string $expected
     */
    public function testGetHttpStatusMessage($provided, $expected)
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass(array(self::$testapi_url));
        $Http->httpStatus = $provided[0];
        $Http->url = $provided[1];
        $response = self::_getProperty('_response', $this->_classToTest);
        $response->setValue($Http, $provided[2]);
        $this->assertEquals($expected, $Http->getHttpStatusMessage());
    }
    
    
    /**
     * @dataProvider providerGetInfo
     * @param string $provided
     * @param string $expected
     * @param string $opt
     */
    public function testGetInfo($provided, $expected, $opt = '')
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass(array(self::$testapi_url));
        $Http->info = $provided;
        
        if ($opt == '') {
            $this->assertEquals($expected, $Http->getInfo());
        } else {
            $this->assertEquals($expected, $Http->getInfo($opt));
        }
    }
    
    
    public function testSetConfigKey()
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass(array(self::$testapi_url));
        $Http->setConfigKey(self::$configkey);
        $this->assertAttributeEquals(self::$configkey, '_configKey', $Http);
        
    }
    
    
    public function testSetHeaders()
    {
        /** @var AbstractHttp $Http */
        $Http = $this->getTestClass(array(self::$testapi_url));
        $Http->setConfigKey(self::$configkey);
        $Http->setHeaders();
        $expected = array(
            'Authorization: Basic ' . base64_encode(self::$user_id . ':' . self::$apikey),
            'Content-Type: application/xml; charset=UTF-8',
            'Accept: application/xml; charset=UTF-8',
            'X-Powered-By: PHP.*',
        );
        $headers = $Http->headers;
        
        foreach ($expected as $i => $reg) {
            $this->assertRegExp('#' . $reg . '#', $headers[$i]);
        }
    }
}