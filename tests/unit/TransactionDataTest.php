<?php

namespace Sofort\SofortLib;

class TransactionDataTest extends TestWrapper
{
    
    protected $_classToTest = 'Sofort\SofortLib\TransactionData';
    
    private $_xml_parse_test_empty = array();
    
    private $_xml_parse_test_multiple = array(
        "transactions" => array(
            "transaction_details" => array(
                0 => array(
                    "project_id" => array(
                        "@data" => "1383",
                        "@attributes" => array(),
                    ),
                    "transaction" => array(
                        "@data" => "00907-01383-50A63DBC-EA71",
                        "@attributes" => array(),
                    ),
                    "test" => array(
                        "@data" => "1",
                        "@attributes" => array(),
                    ),
                    "time" => array(
                        "@data" => "2012-11-16T14:22:30+01:00",
                        "@attributes" => array(),
                    ),
                    "status" => array(
                        "@data" => "refunded",
                        "@attributes" => array(),
                    ),
                    "status_reason" => array(
                        "@data" => "refunded",
                        "@attributes" => array(),
                    ),
                    "status_modified" => array(
                        "@data" => "2012-11-23T14:57:22+01:00",
                        "@attributes" => array(),
                    ),
                    "payment_method" => array(
                        "@data" => "su",
                        "@attributes" => array(),
                    ),
                    "language_code" => array(
                        "@data" => "de",
                        "@attributes" => array(),
                    ),
                    "amount" => array(
                        "@data" => "220.00",
                        "@attributes" => array(),
                    ),
                    "amount_refunded" => array(
                        "@data" => "220.00",
                        "@attributes" => array(),
                    ),
                    "currency_code" => array(
                        "@data" => "EUR",
                        "@attributes" => array(),
                    ),
                    "reasons" => array(
                        "reason" => array(
                            0 => array(
                                "@data" => "SU Testueberweisung",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "@data" => "Test VZ",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "user_variables" => array(
                        "user_variable" => array(
                            0 => array(
                                "@data" => "Something",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "@data" => "Something Else",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "sender" => array(
                        "holder" => array(
                            "@data" => "Max Mustermann",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "23456789",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "00000",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "Demo Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "PNAGDE00000",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE06000000000023456789",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "paycode" => array(
                        "code" => array(
                            "@data" => "12345",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "billcode" => array(
                        "code" => array(
                            "@data" => "54321",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "email_customer" => array(
                        "@data" => "foobar@example.org",
                        "@attributes" => array(),
                    ),
                    "phone_customer" => array(
                        "@data" => "01223 / 4654 - 130,134",
                        "@attributes" => array(),
                    ),
                    "exchange_rate" => array(
                        "@data" => "1.0000",
                        "@attributes" => array(),
                    ),
                    "recipient" => array(
                        "holder" => array(
                            "@data" => "Christian Niehoff",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "117429008",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "70011110",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "SOFORT Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "DEKTDE71002",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE18700111100117429008",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "costs" => array(
                        "fees" => array(
                            "@data" => "0.00",
                            "@attributes" => array(),
                        ),
                        "currency_code" => array(
                            "@data" => "EUR",
                            "@attributes" => array(),
                        ),
                        "exchange_rate" => array(
                            "@data" => "1.0000",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "su" => array(
                        "consumer_protection" => array(
                            "@data" => "0",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "status_history_items" => array(
                        "status_history_item" => array(
                            0 => array(
                                "status" => array(
                                    "@data" => "pending",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "not_credited_yet",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-16T14:22:30+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "status" => array(
                                    "@data" => "received",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "credited",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-16T14:25:29+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            2 => array(
                                "status" => array(
                                    "@data" => "refunded",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "compensation",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-16T14:25:39+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            3 => array(
                                "status" => array(
                                    "@data" => "refunded",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "refunded",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-23T14:57:22+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                1 => array(
                    "project_id" => array(
                        "@data" => "1383",
                        "@attributes" => array(),
                    ),
                    "transaction" => array(
                        "@data" => "00907-01383-50ABA2E6-B526",
                        "@attributes" => array(),
                    ),
                    "test" => array(
                        "@data" => "1",
                        "@attributes" => array(),
                    ),
                    "time" => array(
                        "@data" => "2012-11-20T16:34:17+01:00",
                        "@attributes" => array(),
                    ),
                    "status" => array(
                        "@data" => "pending",
                        "@attributes" => array(),
                    ),
                    "status_reason" => array(
                        "@data" => "not_credited_yet",
                        "@attributes" => array(),
                    ),
                    "status_modified" => array(
                        "@data" => "2012-11-20T16:34:17+01:00",
                        "@attributes" => array(),
                    ),
                    "payment_method" => array(
                        "@data" => "su",
                        "@attributes" => array(),
                    ),
                    "language_code" => array(
                        "@data" => "de",
                        "@attributes" => array(),
                    ),
                    "amount" => array(
                        "@data" => "2.20",
                        "@attributes" => array(),
                    ),
                    "amount_refunded" => array(
                        "@data" => "0.00",
                        "@attributes" => array(),
                    ),
                    "currency_code" => array(
                        "@data" => "EUR",
                        "@attributes" => array(),
                    ),
                    "reasons" => array(
                        "reason" => array(
                            0 => array(
                                "@data" => "SU Testueberweisung",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "@data" => "Test VZ",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "user_variables" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "sender" => array(
                        "holder" => array(
                            "@data" => "Max Mustermann",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "23456789",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "00000",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "Demo Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "PNAGDE00000",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE06000000000023456789",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "paycode" => array(
                        "code" => array(
                            "@data" => "78910",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "billcode" => array(
                        "code" => array(
                            "@data" => "78910",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "email_customer" => array(
                        "@data" => "foobar@example.org",
                        "@attributes" => array(),
                    ),
                    "phone_customer" => array(
                        "@data" => "01223 / 4654 - 130,134",
                        "@attributes" => array(),
                    ),
                    "exchange_rate" => array(
                        "@data" => "1.0000",
                        "@attributes" => array(),
                    ),
                    "recipient" => array(
                        "holder" => array(
                            "@data" => "SOFORT Bank",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "8011742905",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "70011110",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "SOFORT Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "DEKTDE71002",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE70700111108011742905",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "costs" => array(
                        "fees" => array(
                            "@data" => "0.00",
                            "@attributes" => array(),
                        ),
                        "currency_code" => array(
                            "@data" => "EUR",
                            "@attributes" => array(),
                        ),
                        "exchange_rate" => array(
                            "@data" => "1.0000",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "su" => array(
//                        "consumer_protection" => array(
//                            "@data" => "1",
//                            "@attributes" => array(),
//                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "status_history_items" => array(
                        "status_history_item" => array(
                            "status" => array(
                                "@data" => "pending",
                                "@attributes" => array(),
                            ),
                            "status_reason" => array(
                                "@data" => "not_credited_yet",
                                "@attributes" => array(),
                            ),
                            "time" => array(
                                "@data" => "2012-11-20T16:34:17+01:00",
                                "@attributes" => array(),
                            ),
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                2 => array(
                    "project_id" => array(
                        "@data" => "1222",
                        "@attributes" => array(),
                    ),
                    "transaction" => array(
                        "@data" => "00907-01222-50AF6DD4-63E4",
                        "@attributes" => array(),
                    ),
                    "test" => array(
                        "@data" => "1",
                        "@attributes" => array(),
                    ),
                    "time" => array(
                        "@data" => "2012-11-23T13:36:40+01:00",
                        "@attributes" => array(),
                    ),
                    "status" => array(
                        "@data" => "pending",
                        "@attributes" => array(),
                    ),
                    "status_reason" => array(
                        "@data" => "prefinanced",
                        "@attributes" => array(),
                    ),
                    "status_modified" => array(
                        "@data" => "2013-01-22T11:27:54+01:00",
                        "@attributes" => array(),
                    ),
                    "payment_method" => array(
                        "@data" => "sr",
                        "@attributes" => array(),
                    ),
                    "language_code" => array(
                        "@data" => "de",
                        "@attributes" => array(),
                    ),
                    "amount" => array(
                        "@data" => "6.00",
                        "@attributes" => array(),
                    ),
                    "amount_refunded" => array(
                        "@data" => "4.50",
                        "@attributes" => array(),
                    ),
                    "currency_code" => array(
                        "@data" => "EUR",
                        "@attributes" => array(),
                    ),
                    "reasons" => array(
                        "reason" => array(
                            0 => array(
                                "@data" => "Reason Line 1",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "@data" => "Reason Line 2",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "user_variables" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "sender" => array(
                        "holder" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "1229608",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "00000",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "Demo Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "paycode" => array(
                        "code" => array(
                            "@data" => "12121212121",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "billcode" => array(
                        "code" => array(
                            "@data" => "12121212121",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "email_customer" => array(
                        "@data" => "jk@payment-network.com",
                        "@attributes" => array(),
                    ),
                    "phone_customer" => array(
                        "@data" => "0123456789",
                        "@attributes" => array(),
                    ),
                    "exchange_rate" => array(
                        "@data" => "1.0000",
                        "@attributes" => array(),
                    ),
                    "recipient" => array(
                        "holder" => array(
                            "@data" => "Christian Niehoff",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "117429008",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "70011110",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "SOFORT Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "DEKTDE71002",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE18700111100117429008",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "costs" => array(
                        "fees" => array(
                            "@data" => "0.00",
                            "@attributes" => array(),
                        ),
                        "currency_code" => array(
                            "@data" => "EUR",
                            "@attributes" => array(),
                        ),
                        "exchange_rate" => array(
                            "@data" => "1.0000",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "status_history_items" => array(
                        "status_history_item" => array(
                            0 => array(
                                "status" => array(
                                    "@data" => "pending",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "confirm_invoice",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-23T13:36:40+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "status" => array(
                                    "@data" => "pending",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "not_credited_yet",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-23T13:37:34+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            2 => array(
                                "status" => array(
                                    "@data" => "pending",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "prefinanced",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-12-20T15:01:27+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                3 => array(
                    "project_id" => array(
                        "@data" => "1222",
                        "@attributes" => array(),
                    ),
                    "transaction" => array(
                        "@data" => "00907-01222-50AF83D5-6085",
                        "@attributes" => array(),
                    ),
                    "test" => array(
                        "@data" => "1",
                        "@attributes" => array(),
                    ),
                    "time" => array(
                        "@data" => "2012-11-23T15:10:41+01:00",
                        "@attributes" => array(),
                    ),
                    "status" => array(
                        "@data" => "refunded",
                        "@attributes" => array(),
                    ),
                    "status_reason" => array(
                        "@data" => "refunded",
                        "@attributes" => array(),
                    ),
                    "status_modified" => array(
                        "@data" => "2012-11-28T09:39:21+01:00",
                        "@attributes" => array(),
                    ),
                    "payment_method" => array(
                        "@data" => "sr",
                        "@attributes" => array(),
                    ),
                    "language_code" => array(
                        "@data" => "de",
                        "@attributes" => array(),
                    ),
                    "amount" => array(
                        "@data" => "0.00",
                        "@attributes" => array(),
                    ),
                    "amount_refunded" => array(
                        "@data" => "10.50",
                        "@attributes" => array(),
                    ),
                    "currency_code" => array(
                        "@data" => "EUR",
                        "@attributes" => array(),
                    ),
                    "reasons" => array(
                        "reason" => array(
                            0 => array(
                                "@data" => "Reason Line 1",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "@data" => "Reason Line 2",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "user_variables" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "sender" => array(
                        "holder" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "1229608",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "00000",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "Demo Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "paycode" => array(
                        "code" => array(
                            "@data" => "123456",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "billcode" => array(
                        "code" => array(
                            "@data" => "123456",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "email_customer" => array(
                        "@data" => "jk@payment-network.com",
                        "@attributes" => array(),
                    ),
                    "phone_customer" => array(
                        "@data" => "0123456789",
                        "@attributes" => array(),
                    ),
                    "exchange_rate" => array(
                        "@data" => "1.0000",
                        "@attributes" => array(),
                    ),
                    "recipient" => array(
                        "holder" => array(
                            "@data" => "Christian Niehoff",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "117429008",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "70011110",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "SOFORT Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "DEKTDE71002",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE18700111100117429008",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "costs" => array(
                        "fees" => array(
                            "@data" => "0.00",
                            "@attributes" => array(),
                        ),
                        "currency_code" => array(
                            "@data" => "EUR",
                            "@attributes" => array(),
                        ),
                        "exchange_rate" => array(
                            "@data" => "1.0000",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "status_history_items" => array(
                        "status_history_item" => array(
                            0 => array(
                                "status" => array(
                                    "@data" => "pending",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "confirm_invoice",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-23T15:10:41+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "status" => array(
                                    "@data" => "pending",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "not_credited_yet",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-28T09:21:21+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                            2 => array(
                                "status" => array(
                                    "@data" => "refunded",
                                    "@attributes" => array(),
                                ),
                                "status_reason" => array(
                                    "@data" => "refunded",
                                    "@attributes" => array(),
                                ),
                                "time" => array(
                                    "@data" => "2012-11-28T09:39:21+01:00",
                                    "@attributes" => array(),
                                ),
                                "@data" => "",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                4 => array(
                    "project_id" => array(
                        "@data" => "1383",
                        "@attributes" => array(),
                    ),
                    "transaction" => array(
                        "@data" => "00907-01383-50B76B76-0E45",
                        "@attributes" => array(),
                    ),
                    "test" => array(
                        "@data" => "0",
                        "@attributes" => array(),
                    ),
                    "time" => array(
                        "@data" => "2012-11-29T15:05:32+01:00",
                        "@attributes" => array(),
                    ),
                    "status" => array(
                        "@data" => "pending",
                        "@attributes" => array(),
                    ),
                    "status_reason" => array(
                        "@data" => "not_credited_yet",
                        "@attributes" => array(),
                    ),
                    "status_modified" => array(
                        "@data" => "2012-11-29T15:05:32+01:00",
                        "@attributes" => array(),
                    ),
                    "payment_method" => array(
                        "@data" => "su",
                        "@attributes" => array(),
                    ),
                    "language_code" => array(
                        "@data" => "de",
                        "@attributes" => array(),
                    ),
                    "amount" => array(
                        "@data" => "2.20",
                        "@attributes" => array(),
                    ),
                    "amount_refunded" => array(
                        "@data" => "0.00",
                        "@attributes" => array(),
                    ),
                    "currency_code" => array(
                        "@data" => "EUR",
                        "@attributes" => array(),
                    ),
                    "reasons" => array(
                        "reason" => array(
                            0 => array(
                                "@data" => "SU Testueberweisung",
                                "@attributes" => array(),
                            ),
                            1 => array(
                                "@data" => "Test VZ",
                                "@attributes" => array(),
                            ),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "user_variables" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "sender" => array(
                        "holder" => array(
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "30085701",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "51091700",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "Demo Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "PNAGDE00000",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE06000000000023456789",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "paycode" => array(
                        "code" => array(
                            "@data" => "47110815",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "billcode" => array(
                        "code" => array(
                            "@data" => "47110815",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "email_customer" => array(
                        "@data" => "foobar@example.org",
                        "@attributes" => array(),
                    ),
                    "phone_customer" => array(
                        "@data" => "01223 / 4654 - 130,134",
                        "@attributes" => array(),
                    ),
                    "exchange_rate" => array(
                        "@data" => "1.0000",
                        "@attributes" => array(),
                    ),
                    "recipient" => array(
                        "holder" => array(
                            "@data" => "Christian Niehoff",
                            "@attributes" => array(),
                        ),
                        "account_number" => array(
                            "@data" => "117429008",
                            "@attributes" => array(),
                        ),
                        "bank_code" => array(
                            "@data" => "70011110",
                            "@attributes" => array(),
                        ),
                        "bank_name" => array(
                            "@data" => "SOFORT Bank",
                            "@attributes" => array(),
                        ),
                        "bic" => array(
                            "@data" => "DEKTDE71002",
                            "@attributes" => array(),
                        ),
                        "iban" => array(
                            "@data" => "DE18700111100117429008",
                            "@attributes" => array(),
                        ),
                        "country_code" => array(
                            "@data" => "DE",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "costs" => array(
                        "fees" => array(
                            "@data" => "0.00",
                            "@attributes" => array(),
                        ),
                        "currency_code" => array(
                            "@data" => "EUR",
                            "@attributes" => array(),
                        ),
                        "exchange_rate" => array(
                            "@data" => "1.0000",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "su" => array(
                        "consumer_protection" => array(
                            "@data" => "0",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "status_history_items" => array(
                        "status_history_item" => array(
                            "status" => array(
                                "@data" => "pending",
                                "@attributes" => array(),
                            ),
                            "status_reason" => array(
                                "@data" => "not_credited_yet",
                                "@attributes" => array(),
                            ),
                            "time" => array(
                                "@data" => "2012-11-29T15:05:32+01:00",
                                "@attributes" => array(),
                            ),
                            "@data" => "",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
            ),
            "@data" => "",
            "@attributes" => array(),
        ),
    );
    
    private $_xml_parse_test_single = array(
        "transactions" => array(
            "transaction_details" => array(
                "project_id" => array(
                    "@data" => "1222",
                    "@attributes" => array(),
                ),
                "transaction" => array(
                    "@data" => "00907-01222-50F00112-D86E",
                    "@attributes" => array(),
                ),
                "test" => array(
                    "@data" => "1",
                    "@attributes" => array(),
                ),
                "time" => array(
                    "@data" => "2013-01-11T13:10:00+01:00",
                    "@attributes" => array(),
                ),
                "status" => array(
                    "@data" => "pending",
                    "@attributes" => array(),
                ),
                "status_reason" => array(
                    "@data" => "confirm_invoice",
                    "@attributes" => array(),
                ),
                "status_modified" => array(
                    "@data" => "2013-01-11T13:10:00+01:00",
                    "@attributes" => array(),
                ),
                "payment_method" => array(
                    "@data" => "sr",
                    "@attributes" => array(),
                ),
                "language_code" => array(
                    "@data" => "de",
                    "@attributes" => array(),
                ),
                "amount" => array(
                    "@data" => "20.90",
                    "@attributes" => array(),
                ),
                "amount_refunded" => array(
                    "@data" => "0.00",
                    "@attributes" => array(),
                ),
                "currency_code" => array(
                    "@data" => "EUR",
                    "@attributes" => array(),
                ),
                "reasons" => array(
                    "reason" => array(
                        0 => array(
                            "@data" => "Reason Line 1",
                            "@attributes" => array(),
                        ),
                        1 => array(
                            "@data" => "Reason Line 2",
                            "@attributes" => array(),
                        ),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "user_variables" => array(
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "sender" => array(
                    "holder" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "account_number" => array(
                        "@data" => "1229608",
                        "@attributes" => array(),
                    ),
                    "bank_code" => array(
                        "@data" => "00000",
                        "@attributes" => array(),
                    ),
                    "bank_name" => array(
                        "@data" => "Demo Bank",
                        "@attributes" => array(),
                    ),
                    "bic" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "iban" => array(
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "country_code" => array(
                        "@data" => "DE",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "paycode" => array(
                    "code" => array(
                        "@data" => "987654321",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "billcode" => array(
                    "code" => array(
                        "@data" => "987654321",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "email_customer" => array(
                    "@data" => "jk@payment-network.com",
                    "@attributes" => array(),
                ),
                "phone_customer" => array(
                    "@data" => "0123456789",
                    "@attributes" => array(),
                ),
                "exchange_rate" => array(
                    "@data" => "1.0000",
                    "@attributes" => array(),
                ),
                "recipient" => array(
                    "holder" => array(
                        "@data" => "Christian Niehoff",
                        "@attributes" => array(),
                    ),
                    "account_number" => array(
                        "@data" => "117429008",
                        "@attributes" => array(),
                    ),
                    "bank_code" => array(
                        "@data" => "70011110",
                        "@attributes" => array(),
                    ),
                    "bank_name" => array(
                        "@data" => "SOFORT Bank",
                        "@attributes" => array(),
                    ),
                    "bic" => array(
                        "@data" => "DEKTDE71002",
                        "@attributes" => array(),
                    ),
                    "iban" => array(
                        "@data" => "DE18700111100117429008",
                        "@attributes" => array(),
                    ),
                    "country_code" => array(
                        "@data" => "DE",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "costs" => array(
                    "fees" => array(
                        "@data" => "0.00",
                        "@attributes" => array(),
                    ),
                    "currency_code" => array(
                        "@data" => "EUR",
                        "@attributes" => array(),
                    ),
                    "exchange_rate" => array(
                        "@data" => "1.0000",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "status_history_items" => array(
                    "status_history_item" => array(
                        "status" => array(
                            "@data" => "pending",
                            "@attributes" => array(),
                        ),
                        "status_reason" => array(
                            "@data" => "confirm_invoice",
                            "@attributes" => array(),
                        ),
                        "time" => array(
                            "@data" => "2013-01-11T13:10:00+01:00",
                            "@attributes" => array(),
                        ),
                        "@data" => "",
                        "@attributes" => array(),
                    ),
                    "@data" => "",
                    "@attributes" => array(),
                ),
                "@data" => "",
                "@attributes" => array(),
            ),
            "@data" => "",
            "@attributes" => array(),
        ),
    );
    
    public function providerAddTransaction()
    {
        return array(
            array(
                '16263-99178-4E019D4F-5E12'
            ),
            array(
                array(
                    '16263-99178-4E019D4F-5E12',
                    '16263-99178-4E01B143-5E25'
                )
            )
        );
    }
    
    
    public function providerSetNumber()
    {
        return array(
            array(array('10', null)),
        );
    }
    
    
    public function providerSetStatus()
    {
        return array(
            array(
                array(
                    'loss',
                    'pending',
                    'received',
                    'refunded',
                )
            )
        );
    }
    
    
    public function providerSetStatusModifiedTime()
    {
        return array(
            array(
                array(
                    '2012-12-12',
                    '2013-01-01T13:00+02:00'
                )
            )
        );
    }
    
    
    public function providerSetStatusReason()
    {
        return array(
            array(
                array(
                    'not_credited_yet',
                    'not_credited',
                    'refunded',
                    'compensation',
                    'credited',
                    'canceled',
                    'confirm_invoice',
                    'confirmation_period_expired',
                    'wait_for_money',
                    'partially_credited',
                    'overpayment',
                    'rejected',
                    'sofort_bank_account_needed',
                    'prefinanced',
                    'acquired',
                    'late_succeed',
                )
            )
        );
    }
    
    
    public function providerSetTime()
    {
        return array(
            array(
                array(
                    '2012-12-12',
                    '2013-01-01T13:00+02:00'
                )
            ),
        );
    }
    
    
    /**
     * @dataProvider providerAddTransaction
     * @param $provided
     */
    public function testAddTransaction($provided)
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $SofortLibTransactionData->addTransaction($provided);
        $received = $SofortLibTransactionData->getParameters();
        
        if (!is_array($provided)) {
            $provided = array($provided);
        }
        
        $this->assertEquals($provided, $received['transaction']);
    }
    
    
    public function testGetAmount()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['amount']['@data'],
            $SofortLibTransactionData->getAmount(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['amount']['@data'],
            $SofortLibTransactionData->getAmount(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['amount']['@data'],
            $SofortLibTransactionData->getAmount(2)
        );
        $this->assertEquals(0.0, $SofortLibTransactionData->getAmount(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['amount']['@data'],
            $SofortLibTransactionData->getAmount()
        );
    }
    
    
    public function testGetAmountRefunded()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['amount_refunded']['@data'],
            $SofortLibTransactionData->getAmountRefunded(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['amount_refunded']['@data'],
            $SofortLibTransactionData->getAmountRefunded(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['amount_refunded']['@data'],
            $SofortLibTransactionData->getAmountRefunded(2)
        );
        $this->assertEquals(0.0, $SofortLibTransactionData->getAmountRefunded(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['amount_refunded']['@data'],
            $SofortLibTransactionData->getAmountRefunded()
        );
    }
    
    
    public function testGetBillcode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['billcode']['code']['@data'],
            $SofortLibTransactionData->getBillcode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['billcode']['code']['@data'],
            $SofortLibTransactionData->getBillcode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['billcode']['code']['@data'],
            $SofortLibTransactionData->getBillcode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderHolder(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['billcode']['code']['@data'],
            $SofortLibTransactionData->getBillcode()
        );
    }
    
    
    public function testGetConsumerProtection()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        
        if (array_key_exists('su', $this->_xml_parse_test_multiple['transactions']['transaction_details'][0])) {
            $this->assertEquals(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['su']['consumer_protection']['@data'],
                $SofortLibTransactionData->getConsumerProtection(0)
            );
        }
        
        if (array_key_exists('su', $this->_xml_parse_test_multiple['transactions']['transaction_details'][1])) {
            $this->assertFalse($SofortLibTransactionData->getConsumerProtection(1));
        }
        
        if (array_key_exists('su', $this->_xml_parse_test_multiple['transactions']['transaction_details'][2])) {
            $this->assertEquals(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['su']['consumer_protection']['@data'],
                $SofortLibTransactionData->getConsumerProtection(2)
            );
        }
        
        $this->assertFalse($SofortLibTransactionData->getConsumerProtection(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        
        if (array_key_exists('su', $this->_xml_parse_test_multiple['transactions']['transaction_details'])) {
            $this->assertEquals(
                $this->_xml_parse_test_single['transactions']['transaction_details']['su']['consumer_protection']['@data'],
                $SofortLibTransactionData->getConsumerProtection()
            );
        }
    }
    
    
    public function testGetCostsCurrencyCode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['costs']['currency_code']['@data'],
            $SofortLibTransactionData->getCostsCurrencyCode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['costs']['currency_code']['@data'],
            $SofortLibTransactionData->getCostsCurrencyCode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['costs']['currency_code']['@data'],
            $SofortLibTransactionData->getCostsCurrencyCode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientIban(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['costs']['currency_code']['@data'],
            $SofortLibTransactionData->getCostsCurrencyCode()
        );
    }
    
    
    public function testGetCostsExchangeRate()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['costs']['exchange_rate']['@data'],
            $SofortLibTransactionData->getCostsExchangeRate(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['costs']['exchange_rate']['@data'],
            $SofortLibTransactionData->getCostsExchangeRate(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['costs']['exchange_rate']['@data'],
            $SofortLibTransactionData->getCostsExchangeRate(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientIban(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['costs']['exchange_rate']['@data'],
            $SofortLibTransactionData->getCostsExchangeRate()
        );
    }
    
    
    public function testGetCostsFees()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['costs']['fees']['@data'],
            $SofortLibTransactionData->getCostsFees(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['costs']['fees']['@data'],
            $SofortLibTransactionData->getCostsFees(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['costs']['fees']['@data'],
            $SofortLibTransactionData->getCostsFees(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientIban(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals($this->_xml_parse_test_single['transactions']['transaction_details']['costs']['fees']['@data'],
            $SofortLibTransactionData->getCostsFees());
    }
    
    
    public function testGetCount()
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $SofortLibTransactionData->setCount(count($this->_xml_parse_test_multiple));
        $this->assertEquals(count($this->_xml_parse_test_multiple), $SofortLibTransactionData->getCount());
    }
    
    
    public function testGetCurrency()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['currency_code']['@data'],
            $SofortLibTransactionData->getCurrency(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['currency_code']['@data'],
            $SofortLibTransactionData->getCurrency(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['currency_code']['@data'],
            $SofortLibTransactionData->getCurrency(2)
        );
        $this->assertFalse($SofortLibTransactionData->getCurrency(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['currency_code']['@data'],
            $SofortLibTransactionData->getCurrency()
        );
    }
    
    
    public function testGetEmailCustomer()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['email_customer']['@data'],
            $SofortLibTransactionData->getEmailCustomer(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['email_customer']['@data'],
            $SofortLibTransactionData->getEmailCustomer(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['email_customer']['@data'],
            $SofortLibTransactionData->getEmailCustomer(2)
        );
        $this->assertFalse($SofortLibTransactionData->getTransaction(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['email_customer']['@data'],
            $SofortLibTransactionData->getEmailCustomer()
        );
    }
    
    
    public function testGetExchangeRate()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['exchange_rate']['@data'],
            $SofortLibTransactionData->getExchangeRate(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['exchange_rate']['@data'],
            $SofortLibTransactionData->getExchangeRate(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['exchange_rate']['@data'],
            $SofortLibTransactionData->getExchangeRate(2)
        );
        $this->assertFalse($SofortLibTransactionData->getTransaction(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['exchange_rate']['@data'],
            $SofortLibTransactionData->getExchangeRate()
        );
    }
    
    
    public function testGetLanguageCode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['language_code']['@data'],
            $SofortLibTransactionData->getLanguageCode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['language_code']['@data'],
            $SofortLibTransactionData->getLanguageCode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['language_code']['@data'],
            $SofortLibTransactionData->getLanguageCode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getLanguageCode(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['language_code']['@data'],
            $SofortLibTransactionData->getLanguageCode()
        );
    }
    
    
    public function testGetPaycode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['paycode']['code']['@data'],
            $SofortLibTransactionData->getPaycode(0));
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['paycode']['code']['@data'],
            $SofortLibTransactionData->getPaycode(1));
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['paycode']['code']['@data'],
            $SofortLibTransactionData->getPaycode(2));
        $this->assertFalse($SofortLibTransactionData->getSenderHolder(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['paycode']['code']['@data'],
            $SofortLibTransactionData->getPaycode()
        );
    }
    
    
    public function testGetPaymentMethod()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['payment_method']['@data'],
            $SofortLibTransactionData->getPaymentMethod(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['payment_method']['@data'],
            $SofortLibTransactionData->getPaymentMethod(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['payment_method']['@data'],
            $SofortLibTransactionData->getPaymentMethod(2)
        );
        $this->assertFalse($SofortLibTransactionData->getPaymentMethod(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['payment_method']['@data'],
            $SofortLibTransactionData->getPaymentMethod()
        );
    }
    
    
    public function testGetPhoneNumberCustomer()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['phone_customer']['@data'],
            $SofortLibTransactionData->getPhoneNumberCustomer(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['phone_customer']['@data'],
            $SofortLibTransactionData->getPhoneNumberCustomer(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['phone_customer']['@data'],
            $SofortLibTransactionData->getPhoneNumberCustomer(2)
        );
        $this->assertFalse($SofortLibTransactionData->getTransaction(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['phone_customer']['@data'],
            $SofortLibTransactionData->getPhoneNumberCustomer()
        );
    }
    
    
    public function testGetProjectId()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['project_id']['@data'],
            $SofortLibTransactionData->getProjectId(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['project_id']['@data'],
            $SofortLibTransactionData->getProjectId(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['project_id']['@data'],
            $SofortLibTransactionData->getProjectId(2)
        );
        $this->assertFalse($SofortLibTransactionData->getProjectId(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['project_id']['@data'],
            $SofortLibTransactionData->getProjectId()
        );
    }
    
    
    public function testGetReason()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $reason = array(
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['reasons']['reason'][0]['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['reasons']['reason'][1]['@data'],
            ),
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['reasons']['reason'][0]['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['reasons']['reason'][1]['@data'],
            ),
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['reasons']['reason'][0]['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['reasons']['reason'][1]['@data'],
            ),
        );
        $this->assertEquals($reason[0][0], $SofortLibTransactionData->getReason(0));
        $this->assertEquals($reason[0][0], $SofortLibTransactionData->getReason(0, 0));
        $this->assertEquals($reason[0][1], $SofortLibTransactionData->getReason(0, 1));
        $this->assertEquals($reason[1][0], $SofortLibTransactionData->getReason(1));
        $this->assertEquals($reason[1][0], $SofortLibTransactionData->getReason(1, 0));
        $this->assertEquals($reason[1][1], $SofortLibTransactionData->getReason(1, 1));
        $this->assertEquals($reason[2][0], $SofortLibTransactionData->getReason(2));
        $this->assertEquals($reason[2][0], $SofortLibTransactionData->getReason(2, 0));
        $this->assertEquals($reason[2][1], $SofortLibTransactionData->getReason(2, 1));
        $this->assertFalse($SofortLibTransactionData->getReason(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $reason = array(
            array(
                $this->_xml_parse_test_single['transactions']['transaction_details']['reasons']['reason'][0]['@data'],
                $this->_xml_parse_test_single['transactions']['transaction_details']['reasons']['reason'][1]['@data'],
            ),
        );
        $this->assertEquals($reason[0][0], $SofortLibTransactionData->getReason());
        $this->assertEquals($reason[0][0], $SofortLibTransactionData->getReason(0, 0));
        $this->assertEquals($reason[0][1], $SofortLibTransactionData->getReason(0, 1));
    }
    
    
    public function testGetRecipientAccountNumber()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['account_number']['@data'],
            $SofortLibTransactionData->getRecipientAccountNumber(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['account_number']['@data'],
            $SofortLibTransactionData->getRecipientAccountNumber(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['account_number']['@data'],
            $SofortLibTransactionData->getRecipientAccountNumber(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientAccountNumber(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['account_number']['@data'],
            $SofortLibTransactionData->getRecipientAccountNumber()
        );
    }
    
    
    public function testGetRecipientBankCode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['bank_code']['@data'],
            $SofortLibTransactionData->getRecipientBankCode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['bank_code']['@data'],
            $SofortLibTransactionData->getRecipientBankCode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['bank_code']['@data'],
            $SofortLibTransactionData->getRecipientBankCode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientBankCode(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['bank_code']['@data'],
            $SofortLibTransactionData->getRecipientBankCode());
    }
    
    
    public function testGetRecipientBankName()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['bank_name']['@data'],
            $SofortLibTransactionData->getRecipientBankName(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['bank_name']['@data'],
            $SofortLibTransactionData->getRecipientBankName(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['bank_name']['@data'],
            $SofortLibTransactionData->getRecipientBankName(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientBankName(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['bank_name']['@data'],
            $SofortLibTransactionData->getRecipientBankName()
        );
    }
    
    
    public function testGetRecipientBic()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['bic']['@data'],
            $SofortLibTransactionData->getRecipientBic(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['bic']['@data'],
            $SofortLibTransactionData->getRecipientBic(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['bic']['@data'],
            $SofortLibTransactionData->getRecipientBic(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientBic(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['bic']['@data'],
            $SofortLibTransactionData->getRecipientBic()
        );
    }
    
    
    public function testGetRecipientCountryCode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['country_code']['@data'],
            $SofortLibTransactionData->getRecipientCountryCode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['country_code']['@data'],
            $SofortLibTransactionData->getRecipientCountryCode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['country_code']['@data'],
            $SofortLibTransactionData->getRecipientCountryCode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientCountryCode(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['country_code']['@data'],
            $SofortLibTransactionData->getRecipientCountryCode()
        );
    }
    
    
    public function testGetRecipientHolder()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['holder']['@data'],
            $SofortLibTransactionData->getRecipientHolder(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['holder']['@data'],
            $SofortLibTransactionData->getRecipientHolder(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['holder']['@data'],
            $SofortLibTransactionData->getRecipientHolder(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientHolder(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['holder']['@data'],
            $SofortLibTransactionData->getRecipientHolder()
        );
    }
    
    
    public function testGetRecipientIban()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['recipient']['iban']['@data'],
            $SofortLibTransactionData->getRecipientIban(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['recipient']['iban']['@data'],
            $SofortLibTransactionData->getRecipientIban(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['recipient']['iban']['@data'],
            $SofortLibTransactionData->getRecipientIban(2)
        );
        $this->assertFalse($SofortLibTransactionData->getRecipientIban(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['recipient']['iban']['@data'],
            $SofortLibTransactionData->getRecipientIban()
        );
    }
    
    
    public function testGetResponse()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $this->assertEquals($this->_xml_parse_test_multiple, $SofortLibTransactionData->getResponse());
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $this->assertEquals($this->_xml_parse_test_single, $SofortLibTransactionData->getResponse());
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_empty);
        $parse->invoke($SofortLibTransactionData);
        $this->assertEquals($this->_xml_parse_test_empty, $SofortLibTransactionData->getResponse());
    }
    
    
    public function testGetSenderAccountNumber()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['account_number']['@data'],
            $SofortLibTransactionData->getSenderAccountNumber(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['account_number']['@data'],
            $SofortLibTransactionData->getSenderAccountNumber(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['account_number']['@data'],
            $SofortLibTransactionData->getSenderAccountNumber(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderAccountNumber(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['account_number']['@data'],
            $SofortLibTransactionData->getSenderAccountNumber()
        );
    }
    
    
    public function testGetSenderBankCode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['bank_code']['@data'],
            $SofortLibTransactionData->getSenderBankCode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['bank_code']['@data'],
            $SofortLibTransactionData->getSenderBankCode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['bank_code']['@data'],
            $SofortLibTransactionData->getSenderBankCode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderBankCode(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['bank_code']['@data'],
            $SofortLibTransactionData->getSenderBankCode()
        );
    }
    
    
    public function testGetSenderBankName()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['bank_name']['@data'],
            $SofortLibTransactionData->getSenderBankName(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['bank_name']['@data'],
            $SofortLibTransactionData->getSenderBankName(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['bank_name']['@data'],
            $SofortLibTransactionData->getSenderBankName(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderBankName(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['bank_name']['@data'],
            $SofortLibTransactionData->getSenderBankName()
        );
    }
    
    
    public function testGetSenderBic()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['bic']['@data'],
            $SofortLibTransactionData->getSenderBic(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['bic']['@data'],
            $SofortLibTransactionData->getSenderBic(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['bic']['@data'],
            $SofortLibTransactionData->getSenderBic(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderBic(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['bic']['@data'],
            $SofortLibTransactionData->getSenderBic()
        );
    }
    
    
    public function testGetSenderCountryCode()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['country_code']['@data'],
            $SofortLibTransactionData->getSenderCountryCode(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['country_code']['@data'],
            $SofortLibTransactionData->getSenderCountryCode(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['country_code']['@data'],
            $SofortLibTransactionData->getSenderCountryCode(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderCountryCode(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['country_code']['@data'],
            $SofortLibTransactionData->getSenderCountryCode()
        );
    }
    
    
    public function testGetSenderHolder()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['holder']['@data'],
            $SofortLibTransactionData->getSenderHolder(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['holder']['@data'],
            $SofortLibTransactionData->getSenderHolder(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['holder']['@data'],
            $SofortLibTransactionData->getSenderHolder(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderHolder(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['holder']['@data'],
            $SofortLibTransactionData->getSenderHolder()
        );
    }
    
    
    public function testGetSenderIban()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['sender']['iban']['@data'],
            $SofortLibTransactionData->getSenderIban(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['sender']['iban']['@data'],
            $SofortLibTransactionData->getSenderIban(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['sender']['iban']['@data'],
            $SofortLibTransactionData->getSenderIban(2)
        );
        $this->assertFalse($SofortLibTransactionData->getSenderIban(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['sender']['iban']['@data'],
            $SofortLibTransactionData->getSenderIban()
        );
    }
    
    
    public function testGetStatus()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status']['@data'],
            $SofortLibTransactionData->getStatus(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['status']['@data'],
            $SofortLibTransactionData->getStatus(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['status']['@data'],
            $SofortLibTransactionData->getStatus(2)
        );
        $this->assertFalse($SofortLibTransactionData->getStatus(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['status']['@data'],
            $SofortLibTransactionData->getStatus()
        );
    }
    
    
    public function testGetStatusHistoryItem()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][0]['status']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][0]['status_reason']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][0]['time']['@data'],
            ),
            $SofortLibTransactionData->getStatusHistoryItem(0)
        );
        $this->assertEquals(
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][1]['status']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][1]['status_reason']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][1]['time']['@data'],
            ),
            $SofortLibTransactionData->getStatusHistoryItem(0, 1)
        );
        $this->assertEquals(
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][2]['status']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][2]['status_reason']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][2]['time']['@data'],
            ),
            $SofortLibTransactionData->getStatusHistoryItem(0, 2)
        );
        $this->assertEquals(
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][3]['status']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][3]['status_reason']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][3]['time']['@data'],
            ),
            $SofortLibTransactionData->getStatusHistoryItem(0, 3)
        );
        $this->assertEquals(
            array(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['status_history_items']['status_history_item']['status']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['status_history_items']['status_history_item']['status_reason']['@data'],
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['status_history_items']['status_history_item']['time']['@data'],
            ),
            $SofortLibTransactionData->getStatusHistoryItem(1)
        );
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            array(
                $this->_xml_parse_test_single['transactions']['transaction_details']['status_history_items']['status_history_item']['status']['@data'],
                $this->_xml_parse_test_single['transactions']['transaction_details']['status_history_items']['status_history_item']['status_reason']['@data'],
                $this->_xml_parse_test_single['transactions']['transaction_details']['status_history_items']['status_history_item']['time']['@data'],
            ),
            $SofortLibTransactionData->getStatusHistoryItem()
        );
        
        $test = array();
        $test['transactions']['transaction_details'][0]['status_history_items']['status_history_item'][0] = 'test';
        $response->setValue($SofortLibTransactionData, $test);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertFalse($SofortLibTransactionData->getStatusHistoryItem(0, 1));
    }
    
    
    public function testGetStatusModifiedTime()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_modified']['@data'],
            $SofortLibTransactionData->getStatusModifiedTime(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['status_modified']['@data'],
            $SofortLibTransactionData->getStatusModifiedTime(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['status_modified']['@data'],
            $SofortLibTransactionData->getStatusModifiedTime(2)
        );
        $this->assertFalse($SofortLibTransactionData->getStatusModifiedTime(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['status_modified']['@data'],
            $SofortLibTransactionData->getStatusModifiedTime()
        );
    }
    
    
    public function testGetStatusReason()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['status_reason']['@data'],
            $SofortLibTransactionData->getStatusReason(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['status_reason']['@data'],
            $SofortLibTransactionData->getStatusReason(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['status_reason']['@data'],
            $SofortLibTransactionData->getStatusReason(2)
        );
        $this->assertFalse($SofortLibTransactionData->getStatusReason(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['status_reason']['@data'],
            $SofortLibTransactionData->getStatusReason()
        );
    }
    
    
    public function testGetTime()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['time']['@data'],
            $SofortLibTransactionData->getTime(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['time']['@data'],
            $SofortLibTransactionData->getTime(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['time']['@data'],
            $SofortLibTransactionData->getTime(2)
        );
        $this->assertFalse($SofortLibTransactionData->getTime(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['time']['@data'],
            $SofortLibTransactionData->getTime()
        );
    }
    
    
    public function testGetTransaction()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['transaction']['@data'],
            $SofortLibTransactionData->getTransaction(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['transaction']['@data'],
            $SofortLibTransactionData->getTransaction(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['transaction']['@data'],
            $SofortLibTransactionData->getTransaction(2)
        );
        $this->assertFalse($SofortLibTransactionData->getTransaction(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['transaction']['@data'],
            $SofortLibTransactionData->getTransaction()
        );
    }
    
    
    public function testGetUserVariable()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        
        if (isset($this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['user_variables']['user_variable'][0]['@data'])) {
            $this->assertEquals(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['user_variables']['user_variable'][0]['@data'],
                $SofortLibTransactionData->getUserVariable(0, 0)
            );
        }
        
        if (isset($this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['user_variables']['user_variable'][1]['@data'])) {
            $this->assertEquals(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['user_variables']['user_variable'][0]['@data'],
                $SofortLibTransactionData->getUserVariable(1, 1)
            );
        }
        
        if (isset($this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['user_variables']['user_variable'][2]['@data'])) {
            $this->assertEquals(
                $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['user_variables']['user_variable'][0]['@data'],
                $SofortLibTransactionData->getUserVariable(0, 2)
            );
        }
        
        $this->assertFalse($SofortLibTransactionData->getUserVariable(0, -1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        
        if (isset($this->_xml_parse_test_multiple['transactions']['transaction_details']['user_variables']['user_variable'][0]['@data'])) {
            $this->assertEquals(
                $this->_xml_parse_test_multiple['transactions']['transaction_details']['user_variables']['user_variable'][0]['@data'],
                $SofortLibTransactionData->getUserVariable(0)
            );
        }
    }
    
    
    public function testIsTest()
    {
        $parse = self::_getMethod('_parse', $this->_classToTest);
        $response = self::_getProperty('_response', $this->_classToTest);
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_multiple);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][0]['test']['@data'],
            $SofortLibTransactionData->isTest(0)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][1]['test']['@data'],
            $SofortLibTransactionData->isTest(1)
        );
        $this->assertEquals(
            $this->_xml_parse_test_multiple['transactions']['transaction_details'][2]['test']['@data'],
            $SofortLibTransactionData->isTest(2)
        );
        $this->assertFalse($SofortLibTransactionData->isTest(-1));
        
        $response->setValue($SofortLibTransactionData, $this->_xml_parse_test_single);
        $parse->invoke($SofortLibTransactionData);
        $SofortLibTransactionData->getResponse();
        $this->assertEquals(
            $this->_xml_parse_test_single['transactions']['transaction_details']['test']['@data'],
            $SofortLibTransactionData->isTest()
        );
    }
    
    
    public function testSetCount()
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $SofortLibTransactionData->setCount(count($this->_xml_parse_test_multiple));
        $this->assertEquals(count($this->_xml_parse_test_multiple), $SofortLibTransactionData->getCount());
    }
    
    
    /**
     * @dataProvider providerSetNumber
     * @param $provided
     */
    public function testSetNumber($provided)
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $SofortLibTransactionData->setNumber($provided[0], $provided[1]);
        $received = $SofortLibTransactionData->getParameters();
        $this->assertEquals($provided, array($received['number'], $received['page']));
    }
    
    
    /**
     * @dataProvider providerSetStatus
     * @param $provided
     */
    public function testSetStatus($provided)
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        
        foreach ($provided as $status) {
            $SofortLibTransactionData->setStatus($status);
            $received = $SofortLibTransactionData->getParameters();
            $this->assertEquals($status, $received['status']);
        }
    }
    
    
    /**
     * @dataProvider providerSetStatusModifiedTime
     * @param $provided
     */
    public function testSetStatusModifiedTime($provided)
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $SofortLibTransactionData->setStatusModifiedTime($provided[0], $provided[1]);
        $received = $SofortLibTransactionData->getParameters();
        $this->assertEquals(
            $provided,
            array($received['from_status_modified_time'], $received['to_status_modified_time'])
        );
    }
    
    
    /**
     * @dataProvider providerSetStatusReason
     * @param $provided
     */
    public function testSetStatusReason($provided)
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        
        foreach ($provided as $statusReason) {
            $SofortLibTransactionData->setStatusReason($statusReason);
            $received = $SofortLibTransactionData->getParameters();
            $this->assertEquals($statusReason, $received['status_reason']);
        }
    }
    
    
    /**
     * @dataProvider providerSetTime
     * @param $provided
     */
    public function testSetTime($provided)
    {
        $SofortLibTransactionData = new TransactionData(self::$configkey);
        $SofortLibTransactionData->setTime($provided[0], $provided[1]);
        $received = $SofortLibTransactionData->getParameters();
        $this->assertEquals($provided, array($received['from_time'], $received['to_time']));
    }
}