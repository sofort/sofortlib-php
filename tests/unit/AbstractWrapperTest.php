<?php

namespace Sofort\SofortLib;

require_once('TestWrapper.php');

/**
 * Class constructed just to test the methods of the abstract class
 * @author mm
 */
class AbstractWrapperMock extends AbstractWrapper {}

class AbstractWrapperTest extends \TestWrapper {

	protected $_classToTest = 'Sofort\SofortLib\AbstractWrapperMock';
	
	private $_handledErrors = array(
		'global' => array(
			0 => array(
				'code' => 8068,
				'message' => 'Payment type invoice not available for business customers.',
				'field' => '',
			),
			1 => array(
				'code' => 8054,
				'message' => 'All products deactivated due to errors, initiation aborted.',
				'field' => '',
			),
		),
		'su' => array(
			0 => array(
				'code' => 8068,
				'message' => 'Payment type invoice not available for business customers.',
				'field' => 'invoice_address.salutation',
			),
			1 => array(
				'code' => 8068,
				'message' => 'Payment type invoice not available for business customers.',
				'field' => '',
			),
		),
	);
	
	private $_handledErrorsRoot = array(
		0 => array(
			'code' => 8068,
			'message' => 'Payment type invoice not available for business customers.',
			'field' => '',
		),
		1 => array(
			'code' => 8054,
			'message' => 'All products deactivated due to errors, initiation aborted.',
			'field' => '',
		),
		2 => array(
			'code' => '8068.invoice_address.salutation',
			'message' => 'Payment type invoice not available for business customers.',
			'field' => 'invoice_address.salutation',
		),
		3 => array(
			'code' => 8068,
			'message' => 'Payment type invoice not available for business customers.',
			'field' => '',
		),
	);
	
	private $_handledWarnings = array(
		'global' => array(
			0 => array(
				'code' => 8068,
				'message' => 'Payment type invoice not available for business customers.',
				'field' => 'invoice_address.salutation',
			),
			1 => array(
				'code' => 8054,
				'message' => 'All products deactivated due to errors, initiation aborted.',
				'field' => '',
			),
		),
		'su' => array(
			0 => array(
				'code' => 9007,
				'message' => 'Comfortably Numb.',
				'field' => '',
			),
			1 => array(
				'code' => 9008,
				'message' => 'Lorem Ipsim.',
				'field' => '',
			),
		),
	);
	
	private $_handledWarningsRoot = array(
		0 => array(
			'code' => 8068,
			'message' => 'Payment type invoice not available for business customers.',
			'field' => 'invoice_address.salutation',
		),
		1 => array(
			'code' => 8054,
			'message' => 'All products deactivated due to errors, initiation aborted.',
			'field' => '',
		),
		2 => array(
			'code' => 9007,
			'message' => 'Comfortably Numb.',
			'field' => '',
		),
		3 => array(
			'code' => 9008,
			'message' => 'Lorem Ipsim.',
			'field' => '',
		),
	);
	
	
	public function testGetData() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$rootTag = self::_getProperty('_rootTag', $this->_classToTest);
		$rootTag->setValue($AbstractWrapperMock, 'multipay');
		$AbstractWrapperMock->setParameters(array('test'));
		$expected = array(
			'multipay' => array(0 => 'test', 'project_id' => '67890', '@attributes' => array ('version' => '1.0'))
		);
		$this->assertEquals($expected, $AbstractWrapperMock->getData());
	}
	
	
	public function testGetDataHandler() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler', array(), '', FALSE);
		$AbstractWrapperMock->setDataHandler($AbstractDataHandler);
		$this->assertEquals($AbstractDataHandler, $AbstractWrapperMock->getDataHandler());
	}
	
	
	public function providerGetError () {
		return array(
			array(array('test'), 'Error: -1:test',),
			array(array('test'),  'Error: -1:test',),
			array(array('test', 'su'), 'Error: -1:test',),
			array(array('test', 'sr', 4711), 'Error: 4711:test',),
			array(array('test', 'sr', 4711, 'zip'), 'Error: 4711:test',),
			array(array('test', 'not', 4711, 'zip'), 'Error: 4711:test',),
			array(array('', 'not', 4711, 'zip'), 'Error: 4711:',),
		);
	}
	
	
	public function testGetParameters() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$expected = array('test', 'test2');
		$AbstractWrapperMock->setParameters($test_array = array('test', 'test2'));
		$this->assertEquals($expected, $AbstractWrapperMock->getParameters());
	}
	
	
	public function providerIsWarning() {
		return array(
				array(
						array('test'),
						array('global' => array(0 => array('code' => -1, 'message' =>'test', 'field' => ''))),
				),
				array(
						array('test', 'global'),
						array('global' => array(0 => array('code' => -1, 'message' =>'test', 'field' => ''))),
				),
				array(
						array('test', 'su'),
						array('su' => array(0 => array('code' => -1, 'message' =>'test', 'field' => ''))),
				),
				array(
						array('test', 'sr'),
						array('sr' => array(0 => array('code' => 4711, 'message' =>'test', 'field' => ''))),
				),
				array(
						array('test', 'sr'),
						array('sr' => array(0 => array('code' => 4711, 'message' =>'test', 'field' => 'zip'))),
				),
				array(
						array('test', 'not'),
						array('global' => array(0 => array('code' => 4711, 'message' =>'test', 'field' => 'zip'))),
				),
				array(
						array('', 'not'),
						array('global' => array(0 => array('code' => 4711, 'message' =>'', 'field' => 'zip'))),
				),
		);
	}
	
	
	public function providerSetAbortUrl () {
		return array(
			array('http://www.google.de'),
			array('http://www.sofort.com'),
		);
	}
	
	
	public function providerSetApiVersion () {
		return array(
			array('2.0'),
			array('1.1'),
		);
	}


	public function providerSetCurrency () {
		return array(
			array('EUR'),
			array('GBP'),
		);
	}
	
	
	public function providerSetError() {
		return array(
			array(
				array('test'),
				array('global' => array(0 => array('code' => -1, 'message' =>'test', 'field' => ''))),
			),
			array(
				array('test', 'global'),
				array('global' => array(0 => array('code' => -1, 'message' =>'test', 'field' => ''))),
			),
			array(
				array('test', 'su'),
				array('su' => array(0 => array('code' => -1, 'message' =>'test', 'field' => ''))),
			),
			array(
				array('test', 'sr', 4711),
				array('sr' => array(0 => array('code' => 4711, 'message' =>'test', 'field' => ''))),
			),
			array(
				array('test', 'sr', 4711, 'zip'),
				array('sr' => array(0 => array('code' => 4711, 'message' =>'test', 'field' => 'zip'))),
			),
			array(
				array('test', 'not', 4711, 'zip'),
				array('global' => array(0 => array('code' => 4711, 'message' =>'test', 'field' => 'zip'))),
			),
			array(
				array('', 'not', 4711, 'zip'),
				array('global' => array(0 => array('code' => 4711, 'message' =>'', 'field' => 'zip'))),
			),
		);
	}
	
	
	public function providerSetNotificationEmail () {
		return array(
			array('test@test.de'),
			array(array('test@test.de', "loss")),
		);
	}
	
	
	public function providerSetNotificationUrl () {
		return array(
			array('http://www.google.de'),
			array(array('http://www.google.de', "loss")),
		);
	}
	
	
	public function providerSetSuccessUrl () {
		return array(
			array('http://www.google.de'),
			array('http://www.sofort.com', false),
		);
	}
	
	
	public function providerSetTimeoutUrl () {
		return array(
			array('http://www.google.de'),
			array('http://www.sofort.com'),
		);
	}
	
	
	public function testAbstractSofortLib() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		$AbstractWrapperMock->setParameters(array(array('miep' => 'moep')));
		$this->assertEquals(array(array('miep' => 'moep')), $AbstractWrapperMock->getParameters());
		
		$AbstractWrapperMock->setConfigKey(self::$configkey);
		$this->assertEquals(self::$configkey, $AbstractWrapperMock->getConfigKey());
	}
	
	
	/**
	 * @dataProvider providerIsWarning
	 */
	public function testIsWarning ($provided, $expected) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->warnings = $expected;
		
		if(isset($provided[1]) && in_array($provided[1], array('global', 'su', 'sr', 'not'))) {
			$provided[1] = ($provided[1] == 'not') ? 'all' : $provided[1];
			$this->assertTrue($AbstractWrapperMock->isWarning($provided[1]));
			$this->assertFalse($AbstractWrapperMock->isWarning($provided[1], 'test'));
		} else {
			$this->assertTrue($AbstractWrapperMock->isWarning());
		}
		
		$AbstractWrapperMock->warnings = 'test';
		$this->assertEquals('test', $AbstractWrapperMock->warnings);
		
		$AbstractWrapperMock->warnings = NULL;
		$this->assertFalse($AbstractWrapperMock->isWarning('all'));
	}
	
	
	public function testGetConfigKey() {
		$configKey = '12345:12345:abcdefghijklmnopqrstuvewxyz123456';
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setConfigKey($configKey);
		$this->assertEquals($AbstractWrapperMock->getConfigKey(), $configKey);
	}
	
	
	/**
	 * @dataProvider providerGetError
	 */
	public function testGetError($provided, $expected) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		if(count($provided) == 4) {
			$AbstractWrapperMock->setError($provided[0], $provided[1], $provided[2], $provided[3]);
		} else if (count($provided) == 3) {
			$AbstractWrapperMock->setError($provided[0], $provided[1], $provided[2]);
		} else if (count($provided) == 2) {
			$AbstractWrapperMock->setError($provided[0], $provided[1]);
		} else {
			$AbstractWrapperMock->setError($provided[0]);
		}
		
		if(isset($provided[1]) && in_array($provided[1], array('global', 'su', 'sr', 'not',))) {
			$provided[1] = ($provided[1] == 'not') ? 'all' : $provided[1];
			$this->assertFalse($AbstractWrapperMock->getError($provided[1], 'test'));
			$this->assertEquals($expected, $AbstractWrapperMock->getError($provided[1]));
		} else {
			$this->assertEquals($expected, $AbstractWrapperMock->getError());
		}
		
		$this->assertFalse($AbstractWrapperMock->getError('su', array('testen' => 'test')));
	}
	
	
	public function testGetErrors() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		$AbstractWrapperMock->errors = $this->_handledErrors;
		$this->assertEquals($this->_handledErrorsRoot, $AbstractWrapperMock->getErrors());
		
		unset($AbstractWrapperMock->errors);
		$this->assertEquals(array(), $AbstractWrapperMock->getErrors('all', 'something'));
	}
	
	
	public function testGetLogger() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$FileLoggerHandler = $this->getMockForAbstractClass('Sofort\SofortLib\FileLogger');
		$AbstractWrapperMock->setLogger($FileLoggerHandler);
		$this->assertEquals($AbstractWrapperMock->getLogger(), $FileLoggerHandler);
	}
	
	
	public function testGetRawRequest() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler',
				array(),
				'',
				FALSE,
				TRUE,
				TRUE,
				array('getRawRequest'));
		
		$AbstractDataHandler->expects($this->any())->method('getRawRequest');
		$AbstractWrapperMock->setDataHandler($AbstractDataHandler);
		$this->assertEquals(NULL, $AbstractWrapperMock->getRawRequest());
	}
	
	
	public function testGetRawResponse() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler',
				array(),
				'',
				FALSE,
				TRUE,
				TRUE,
				array('getRawResponse'));
		
		$AbstractDataHandler->expects($this->any())->method('getRawResponse');
		$AbstractWrapperMock->setDataHandler($AbstractDataHandler);
		$this->assertEquals(NULL, $AbstractWrapperMock->getRawResponse());
	}
	
	
	public function testGetRequest() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$request = self::_getProperty('_request', $this->_classToTest);
		$testdata = 'sometestdata';
		$request->setValue($AbstractWrapperMock, $testdata);
		$this->assertEquals($testdata, $AbstractWrapperMock->getRequest());
	}
	
	
	public function testGetWarnings() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->warnings = $this->_handledWarnings;
		$this->assertEquals($this->_handledWarningsRoot, $AbstractWrapperMock->getWarnings());
	}
	
	
	public function testLog() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$FileLoggerHandler = $this->getMockForAbstractClass('Sofort\SofortLib\FileLogger');
		$FileLoggerHandler->expects($this->any())->method('log')->with('log')->will($this->returnValue('log'));
		
		$AbstractWrapperMock->setLogger($FileLoggerHandler);
		$AbstractWrapperMock->setLogEnabled();
		$this->assertNull($AbstractWrapperMock->log('log'));
	}
	
	
	public function testLogError() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$FileLoggerHandler = $this->getMockForAbstractClass('Sofort\SofortLib\FileLogger');
		$FileLoggerHandler->expects($this->any())->method('log')->with('error')->will($this->returnValue('error'));
		
		$AbstractWrapperMock->setLogger($FileLoggerHandler);
		$AbstractWrapperMock->setLogEnabled();
		$this->assertNull($AbstractWrapperMock->logError('error'));
	}
	
	
	public function testLogWarning() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		$FileLoggerHandler = $this->getMockForAbstractClass('Sofort\SofortLib\FileLogger');
		$FileLoggerHandler->expects($this->any())->method('log')->with('warning')->will($this->returnValue('warning'));
		
		$AbstractWrapperMock->setLogger($FileLoggerHandler);
		$AbstractWrapperMock->setLogEnabled();
		$this->assertNull($AbstractWrapperMock->logWarning('warning'));
	}
	
	
	public function testSendRequest () {
		$validate_only = self::_getProperty('_validateOnly', $this->_classToTest);
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler',
				array(),
				'',
				FALSE,
				TRUE,
				TRUE,
				array('handle', 'getRequest', 'getRawResponse'));
		
		$validate_only->setValue($AbstractWrapperMock, true);
		$AbstractWrapperMock->setDataHandler($AbstractDataHandler);
		$AbstractWrapperMock->sendRequest();
	}
	
	
	/**
	 * @dataProvider providerSetAbortUrl
	 */
	public function testSetAbortUrl ($provided) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setAbortUrl($provided);
		$received = $AbstractWrapperMock->getParameters();
		$this->assertEquals($provided, $received['abort_url']);
	}


	/**
	 * @dataProvider providerSetApiVersion
	 */
	public function testSetApiVersion ($provided){
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setApiVersion($provided);
		$this->assertAttributeEquals($provided, '_apiVersion', $AbstractWrapperMock);
	}
	
	
	public function testSetConfigKey() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$configKey = '12345:12345:abcdefghijklmnopqrstuvewxyz123456';
		$AbstractWrapperMock->setConfigKey($configKey);
		$this->assertEquals($AbstractWrapperMock->getConfigKey(), $configKey);
	}
	
	
	/**
	 * @dataProvider providerSetCurrency
	 */
	public function testSetCurrencyCode ($provided) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setCurrencyCode($provided);
		$received = $AbstractWrapperMock->getParameters();
		$this->assertEquals($provided, $received['currency_code']);
	}
	
	
	public function testSetDataHandler() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractDataHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractDataHandler', array(), '', FALSE);
		$AbstractWrapperMock->setDataHandler($AbstractDataHandler);
		$this->assertEquals($AbstractDataHandler, $AbstractWrapperMock->getDataHandler());
	}
	
	
	/**
	 * @dataProvider providerSetError
	 */
	public function testSetError($provided, $expected) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$this->assertFalse($AbstractWrapperMock->isError());
		
		if(count($provided) == 4) {
			$AbstractWrapperMock->setError($provided[0], $provided[1], $provided[2], $provided[3]);
		} else if (count($provided) == 3) {
			$AbstractWrapperMock->setError($provided[0], $provided[1], $provided[2]);
		} else if (count($provided) == 2) {
			$AbstractWrapperMock->setError($provided[0], $provided[1]);
		} else {
			$AbstractWrapperMock->setError($provided[0]);
		}
		
		$this->assertEquals($expected, $AbstractWrapperMock->errors);
		
		if(isset($provided[1]) && in_array($provided[1], array('global', 'su', 'sr', 'not'))) {
			$provided[1] = ($provided[1] == 'not') ? 'all' : $provided[1];
			$this->assertTrue($AbstractWrapperMock->isError($provided[1]));
			$this->assertFalse($AbstractWrapperMock->isError($provided[1], 'test'));
		} else {
			$this->assertTrue($AbstractWrapperMock->isError());
		}
	}
	
	
	public function testSetLogDisabled() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setLogEnabled();
		$AbstractWrapperMock->setLogDisabled();
		$this->assertFalse($AbstractWrapperMock->enableLogging);
	}
	
	
	public function testSetLogEnabled() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setLogDisabled();
		$AbstractWrapperMock->setLogEnabled();
		$this->assertTrue($AbstractWrapperMock->enableLogging);
	}
	
	
	public function testSetLogger() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractLoggerHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractLoggerHandler');
		$AbstractWrapperMock->setLogger($AbstractLoggerHandler);
		$this->assertAttributeEquals($AbstractLoggerHandler, '_Logger', $AbstractWrapperMock);
	}
	
	
	/**
	 * @dataProvider providerSetNotificationEmail
	 */
	public function testSetNotificationEmail ($provided) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		if(!is_array($provided)) {
			$AbstractWrapperMock->setNotificationEmail($provided);
			$received = $AbstractWrapperMock->getParameters();
			$this->assertEquals($provided, $received['notification_emails']['notification_email'][0]['@data']);
		} else {
			$AbstractWrapperMock->setNotificationEmail($provided[0], $provided[1]);
			$received = $AbstractWrapperMock->getParameters();
			$this->assertEquals($provided[0], $received['notification_emails']['notification_email'][0]['@data']);
		}
	}
	
	
	/**
	 * @dataProvider providerSetNotificationUrl
	 */
	public function testSetNotificationUrl ($provided) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		if(!is_array($provided)) {
			$AbstractWrapperMock->setNotificationUrl($provided);
			$received = $AbstractWrapperMock->getParameters();
			$this->assertEquals($provided, $received['notification_urls']['notification_url'][0]['@data']);
		} else {
			$AbstractWrapperMock->setNotificationUrl($provided[0], $provided[1]);
			$received = $AbstractWrapperMock->getParameters();
			$this->assertEquals($provided[0], $received['notification_urls']['notification_url'][0]['@data']);
		}
	}
	
	
	/**
	 * @dataProvider providerSetSuccessUrl
	 */
	public function testSetSuccessUrl ($provided) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		
		if(isset($provided[1])) {
			$AbstractWrapperMock->setSuccessUrl($provided[0], $provided[1]);
		} else {
			$AbstractWrapperMock->setSuccessUrl($provided[0]);
		}
		
		$received = $AbstractWrapperMock->getParameters();
		$this->assertEquals($provided[0], $received['success_url']);
		$this->assertEquals($provided[1], $received['success_link_redirect']);
	}
	
	
	public function testSetParameters() {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$expected = array('test', 'test2');
		$AbstractWrapperMock->setParameters($test_array = array('test', 'test2'));
		$this->assertEquals($expected, $AbstractWrapperMock->getParameters());
	}
	
	
	/**
	 * @dataProvider providerSetTimeoutUrl
	 */
	public function testSetTimeoutUrl ($provided) {
		$AbstractWrapperMock = new AbstractWrapperMock(self::$configkey);
		$AbstractWrapperMock->setTimeoutUrl($provided);
		$received = $AbstractWrapperMock->getParameters();
		$this->assertEquals($provided, $received['timeout_url']);
	}
}