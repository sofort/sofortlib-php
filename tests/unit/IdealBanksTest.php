<?php

namespace Sofort\SofortLib;

class IdealBanksTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\IdealBanks';
    
    public function testGetBanks()
    {
        $SofortLibIdealBanks = new IdealBanks(self::$ideal_configkey);
        $banksInput = array(
            'ideal' => array(
                'banks' => array(
                    'bank' => array(
                        0 => array(
                            'code' => array(
                                '@data' => 31,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'ABN Amro',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        1 => array(
                            'code' => array(
                                '@data' => 91,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'Friesland Bank',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        2 => array(
                            'code' => array(
                                '@data' => 721,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'ING',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        3 => array(
                            'code' => array(
                                '@data' => 21,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'Rabobank',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        4 => array(
                            'code' => array(
                                '@data' => 751,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'SNS Bank',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        5 => array(
                            'code' => array(
                                '@data' => 761,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'ASN Bank',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        6 => array(
                            'code' => array(
                                '@data' => 9998,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'Knab',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        7 => array(
                            'code' => array(
                                '@data' => 771,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'RegioBank',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        8 => array(
                            'code' => array(
                                '@data' => 511,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'Triodos Bank',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                        9 => array(
                            'code' => array(
                                '@data' => 161,
                                '@attributes' => array(),
                            ),
                            'name' => array(
                                '@data' => 'Van Lanschot Bankiers',
                                '@attributes' => array(),
                            ),
                            '@data' => '',
                            '@attributes' => array(),
                        ),
                    ),
                    '@data' => '',
                    '@attributes' => array(),
                ),
                '@data' => '',
                '@attributes' => array(),
            ),
        );
        $banks = array(
            0 => array(
                'code' => 31,
                'name' => 'ABN Amro',
            ),
            1 => array(
                'code' => 91,
                'name' => 'Friesland Bank',
            ),
            2 => array(
                'code' => 721,
                'name' => 'ING',
            ),
            3 => array(
                'code' => 21,
                'name' => 'Rabobank',
            ),
            4 => array(
                'code' => 751,
                'name' => 'SNS Bank',
            ),
            5 => array(
                'code' => 761,
                'name' => 'ASN Bank',
            ),
            6 => array(
                'code' => 9998,
                'name' => 'Knab',
            ),
            7 => array(
                'code' => 771,
                'name' => 'RegioBank',
            ),
            '8' => array(
                'code' => 511,
                'name' => 'Triodos Bank',
            ),
            '9' => array(
                'code' => 161,
                'name' => 'Van Lanschot Bankiers',
            ),
        );
        
        $response = self::_getProperty('_response', $this->_classToTest);
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response->setValue($SofortLibIdealBanks, $banksInput);
        $parse->invoke($SofortLibIdealBanks);
        $this->assertEquals($banks, $SofortLibIdealBanks->getBanks());
    }
}