<?php
namespace Sofort\SofortLib;

require __DIR__ . '/../vendor/autoload.php';

// Enter your configuration key.
// You only can create a new configuration key by creating a new Gateway project in your account at sofort.com
define('CONFIGKEY', '12345:123456:edc788a4316ce7e2ac0ede037aa623d7');
define('PASSWORD', 'password_password');

$SofortIdeal = new Ideal(CONFIGKEY, PASSWORD);
// $SofortIdeal = new Ideal(CONFIGKEY, PASSWORD, 'md5');
// $SofortIdeal = new Ideal(CONFIGKEY, PASSWORD, 'sha256');
$SofortIdeal->setReason('Testzweck', 'Testzweck4');
$SofortIdeal->setAmount(10);
// $SofortIdeal->setSenderHolder('Name of Sender');
// $SofortIdeal->setSenderAccountNumber('2345678902');
$SofortIdeal->setSenderBankCode('31');
$SofortIdeal->setSenderCountryId('NL');
//$SofortIdeal->setUserVariable('User-Var 1');
//$SofortIdeal->setUserVariable('User-Var 2');
//$SofortIdeal->setUserVariable('User-Var 3');
// $SofortIdeal->setLanguageCode('EN');
// $SofortIdeal->setVersion('Framework 0.0.1');
// $SofortIdeal->setTimeout('300');

echo 'User should be redirected to: <a href="'.$SofortIdeal->getPaymentUrl().'" target="_blank">Link</a>';
