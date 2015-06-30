<?php
namespace Sofort\SofortLib;

class AbstractDataHandlerTest extends TestWrapper
{
    
    protected $_classToTest = '\Sofort\SofortLib\AbstractDataHandler';
    
    public function providerGetApiKey()
    {
        return array(
            array('4545434ff4493tej394gf343',),
        );
    }
    
    
    public function providerGetProjectId()
    {
        return array(
            array(4711,),
            array(20,),
        );
    }
    
    
    public function providerGetUserId()
    {
        return array(
            array(4711,),
            array(20,),
        );
    }
    
    
    /**
     * @dataProvider providerGetApiKey
     * @param string $provided
     */
    public function testGetApiKey($provided)
    {
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass($this->_classToTest, array(self::$configkey));
        $this->assertEquals(self::$apikey, $AbstractDataHandler->getApiKey());
        
        $AbstractDataHandler->setApiKey($provided);
        $this->assertEquals($provided, $AbstractDataHandler->getApiKey());
    }
    
    
    /**
     * @dataProvider providerGetProjectId
     * @param string $provided
     */
    public function testGetProjectId($provided)
    {
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass($this->_classToTest, array(self::$configkey));
        $this->assertEquals(self::$project_id, $AbstractDataHandler->getProjectId());
        
        $AbstractDataHandler->setProjectId($provided);
        $this->assertEquals($provided, $AbstractDataHandler->getProjectId());
    }
    
    
    public function testGetRawRequest()
    {
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass($this->_classToTest, array(self::$configkey));
        $raw_request = self::_getProperty('_rawRequest', $this->_classToTest);
        $testdata = 'sometestdata';
        $raw_request->setValue($AbstractDataHandler, $testdata);
        $this->assertEquals($testdata, $AbstractDataHandler->getRawRequest());
    }
    
    
    public function testGetRawResponse()
    {
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass($this->_classToTest, array(self::$configkey));
        $raw_response = self::_getProperty('_rawResponse', $this->_classToTest);
        $testdata = 'sometestdata';
        $raw_response->setValue($AbstractDataHandler, $testdata);
        $this->assertEquals($testdata, $AbstractDataHandler->getRawResponse());
    }
    
    
    public function testGetRequest()
    {
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass($this->_classToTest, array(self::$configkey));
        $request = self::_getProperty('_request', $this->_classToTest);
        $testdata = 'sometestdata';
        $request->setValue($AbstractDataHandler, $testdata);
        $this->assertEquals($testdata, $AbstractDataHandler->getRequest());
    }
    
    
    /**
     ** @dataProvider providerGetUserId
     * @param string $provided
     */
    public function testGetUserId($provided)
    {
        /** @var AbstractDataHandler $AbstractDataHandler */
        $AbstractDataHandler = $this->getMockForAbstractClass($this->_classToTest, array(self::$configkey));
        $this->assertEquals(self::$user_id, $AbstractDataHandler->getUserId());
        
        $AbstractDataHandler->setUserId($provided);
        $this->assertEquals($provided, $AbstractDataHandler->getUserId());
    }
}