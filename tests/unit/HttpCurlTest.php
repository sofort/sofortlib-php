<?php

namespace Sofort\SofortLib;

use Sofort\SofortLib\Http\HttpCurl;

if (!defined('SOFORTLIB_VERSION')) {
    define('SOFORTLIB_VERSION', '3.0.0');
}

class HttpCurlTest extends TestWrapper
{
    
    public function testPost()
    {
        /** @var HttpCurl|\PHPUnit_Framework_MockObject_MockObject $MockPost */
        $MockPost = $this->getMock(
            'Sofort\SofortLib\Http\HttpCurl',
            array('_curlRequest'),
            array('http://www.sofort.com', 'gzip', 'http://www.sofort.com')
        );
        
        $MockPost->setConfigKey(self::$configkey);
        $MockPost->expects($this->any())->method('_curlRequest')->will($this->returnValue(true));
        
        $this->assertEquals(true, $MockPost->post('data', 'url', array()));
        $this->assertEquals(true, $MockPost->post('data', false, false));
        
        $MockPost->error = 'Test';
        $this->assertEquals(
            '<errors><error><code>000Test</code><message></message></error></errors>',
            $MockPost->post('data', 'url', array())
        );
    }
}