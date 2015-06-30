<?php

namespace Sofort\SofortLib;

class FileLoggerTest extends \PHPUnit_Framework_TestCase
{
    
    public function testConstruct()
    {
        $SofortLibLogger = new FileLogger();
        $this->assertAttributeEquals(
            realpath(dirname(__FILE__) . '/../../src') . '/logs/log.txt', '_logfilePath', $SofortLibLogger
        );
    }
    
    
    public function testLog()
    {
        /** @var FileLogger|\PHPUnit_Framework_MockObject_MockObject $stub */
        $stub = $this->getMock('\Sofort\SofortLib\FileLogger', array('_log'));
        $stub->expects($this->at(0))->method('_log')->with('log')->will($this->returnValue('log'));
        $this->assertEquals('log', $stub->log('log'));
        
        $stub->expects($this->at(0))->method('_log')->with('error')->will($this->returnValue('error'));
        $this->assertEquals('error', $stub->log('error'));
        
        $stub->expects($this->at(0))->method('_log')->with('warning')->will($this->returnValue('warning'));
        $this->assertEquals('warning', $stub->log('warning'));
    }
    
    
    public function testLogRotate()
    {
        $SofortLibLogger = new FileLogger();
        $SofortLibLogger->maxFilesize = 1;
        $SofortLibLogger->log(
            'Aged, tangy pudding is best whisked with hot cream.What’s the secret to a sour and shredded cauliflower? Always use crushed vodka.'
        );
        $SofortLibLogger->log(
            'Brush the tuna with sticky garlic, szechuan pepper, dill, and butterscotch making sure to cover all of it.'
        );
        $SofortLibLogger->log(
            'Caviar pudding has to have a tasty, whole rice component.'
        );
        $SofortLibLogger->log(
            'Try marinating the milk garlics with nutty condensed milk and bourbon, refrigerated.'
        );
        $SofortLibLogger->log(
            'Shrimps taste best with anchovy essence and lots of nutmeg.'
        );
        $SofortLibLogger->log(
            'Soak one package of cabbage in one cup of joghurt.'
        );
        $SofortLibLogger->log(
            'Clammy, quartered pudding is best mixed with divided salsa verde.'
        );
    }
    
    
    public function testLogWriting()
    {
        $SofortLibLogger = new FileLogger();
        $this->assertTrue($SofortLibLogger->log('test', 'log'));
    }
    
    
    public function testSetLogfilePath()
    {
        $SofortLibLogger = new FileLogger('wusel');
        $this->assertAttributeEquals('wusel', '_logfilePath', $SofortLibLogger);
        
        $SofortLibLogger->setLogfilePath('test');
        $this->assertAttributeEquals('test', '_logfilePath', $SofortLibLogger);
    }
}