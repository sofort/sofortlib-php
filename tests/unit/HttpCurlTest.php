<?php

namespace Sofort\SofortLib;

class HttpCurlTest extends TestWrapper
{
    
    public function testPost()
    {
        /** @var HttpCurl|\PHPUnit_Framework_MockObject_MockObject $MockPost */
        $MockPost = $this->getMockBuilder('Sofort\SofortLib\HttpCurl')
            ->setMethods(array('_curlRequest'))
            ->setConstructorArgs(array('http://www.sofort.com', 'gzip', 'http://www.sofort.com'))
            ->getMock();
        
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