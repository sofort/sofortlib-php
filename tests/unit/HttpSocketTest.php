<?php

namespace Sofort\SofortLib;

if (!defined('SOFORTLIB_VERSION')) {
    define('SOFORTLIB_VERSION', '3.0.0');
}

class HttpSocketTest extends TestWrapper
{
    
    protected $_mockPayload = '<?xml version="1.0" encoding="UTF-8" ?>
<invoices><invoice><transaction>00907-01222-4F86CFEA-7F0B</transaction><status>ERROR</status><errors><error><code>9000</code><message>No invoice transaction found.</message></error></errors></invoice><invoice><transaction>00907-01222-4F86CE5D-B216</transaction><status>ERROR</status><errors><error><code>9000</code><message>No invoice transaction found.</message></error></errors></invoice></invoices>';
    
    protected $_postPayload = '<?xml version="1.0" encoding="UTF-8" ?>
<transactions />';
    
    protected $_request = '<?xml version="1.0" encoding="UTF-8" ?>
<transaction_request version="1.0"><transaction>00000</transaction></transaction_request>';
    
    protected $_response = <<<EOT
HTTP/1.1 200 OK
Date: Tue, 12 Feb 2013 15:02:47 GMT
Server: Apache
Content-Length: 441
Connection: close
Content-Type: application/xml\r\n\r\n<?xml version="1.0" encoding="UTF-8" ?>
<invoices><invoice><transaction>00907-01222-4F86CFEA-7F0B</transaction><status>ERROR</status><errors><error><code>9000</code><message>No invoice transaction found.</message></error></errors></invoice><invoice><transaction>00907-01222-4F86CE5D-B216</transaction><status>ERROR</status><errors><error><code>9000</code><message>No invoice transaction found.</message></error></errors></invoice></invoices>
EOT;
    
    
    public function testPost()
    {
        /** @var HttpSocket|\PHPUnit_Framework_MockObject_MockObject $MockPost */
        $MockPost = $this->getMock(
            '\Sofort\SofortLib\HttpSocket',
            array('_socketRequest'),
            array(self::$testapi_url, 'gzip', 'http://www.sofort.com')
        );
        
        $MockPost->setConfigKey(self::$configkey);
        $MockPost->expects($this->any())->method('_socketRequest')->will($this->returnValue($this->_response));
        
        $this->assertEquals($this->_mockPayload, $MockPost->post('data', false, false));
        
        $MockPost->error = 'Test';
        $this->assertEquals(
            '<errors><error><code>000Test</code><message></message></error></errors>',
            $MockPost->post('data')
        );
    }
    
    
    public function testPostViaSocket()
    {
        $url = 'https://www.sofort.com/payment/notAvailable';
        $SofortLibHttpSocket = new HttpSocket($url);
        
        $SofortLibHttpSocket->post('test');
        $httpCode = $SofortLibHttpSocket->getHttpCode();
        $this->assertTrue($httpCode['code'] === 404);
        $this->assertTrue(
            $httpCode['message'] === '<errors><error><code>0404</code><message>URL not found ' . $url . '</message></error></errors>'
        );
    }
}
