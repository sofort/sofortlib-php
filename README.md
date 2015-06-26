# SofortLib-PHP @ SOFORT GmbH

[![Build Status](https://travis-ci.org/sofort/sofortlib-php.svg)](https://travis-ci.org/sofort/sofortlib-php)

This documentation explains the SofortLib PHP, its parts, how to set it up and how to test it.

## DESCRIPTION

Integrate the SofortLib PHP into your project to communicate via PHP with the SOFORT API.

Find out more about the SOFORT API/SDK here:
https://www.sofort.com/integrationCenter-eng-DE/integration/API-SDK/

SofortLib PHP Supports the following SOFORT Products:

1. SOFORT Überweisung (SOFORT Banking/Payment)
2. SOFORT Paycode
3. SOFORT Billcode
4. Refund
5. iDEAL


## Install

Install the `sofort/sofortlib-php` package using composer:

```json
{
    "require": {
        "sofort/sofortlib-php": "3.*"
    }
}
```


## SofortLib Package

The SofortLib PHP package contains the following: 

- the `/src` directory with the class-files
- an `/examples` folder, with examples of usage
- the folder `/test` with the unittests (for PHP Unit).



## Functionality

- initiate a SOFORT Überweisung
- create/initiate a SOFORT Überweisung Paycode
- create/initiate a SOFORT Überweisung Billcode
- getting the details for one or more transactions
- getting the details for a period and/or status
- convert received XML to a PHP Object
- marking refunds
- getting the current iDEAL Bank list
- generate a forward URL for the iDEAL payment data
- creating checksum/hash for iDEAL Payment data
- creating checksum/hash for iDEAL Notifications


## Usage

Find examples of usage for the different modules in the `/examples` directory.

## Testing 

Run the tests

```
./vendor/bin/phpunit
```
