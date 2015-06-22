<?php

namespace Sofort\SofortLib;

class AbstractLoggerHandlerTest extends \PHPUnit_Framework_TestCase {
	
	public function testConstruct () {
		$AbstractLoggerHandler = $this->getMockForAbstractClass('Sofort\SofortLib\AbstractLoggerHandler');
	}
}