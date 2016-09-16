<?php

require __DIR__ . '/../vendor/autoload.php';

use Sofort\SofortLib\Billcode;

// Enter your configuration key.
// You can only create a new configuration key by creating a new Gateway project in your account at sofort.com
$configkey = '12345:123456:edc788a4316ce7e2ac0ede037aa623d7';

$SofortLibBillcode = new Billcode($configkey);

$SofortLibBillcode->setAmount(5.55)
    ->setCurrencyCode('EUR')
    ->setSenderBankCode('00000')
    ->setReason('Reason Line 1', 'Reason Line 2')
    ->setSuccessUrl('http://www.google.de')
    ->setSuccessLinkRedirect(0)
    ->setAbortUrl('http://www.sofort.com')
    ->setNotificationUrl('http://www.diesundjenes.de/notify')
    ->setUserVariable('schwuppsen')
//    ->setLanguageCode('de')
//    ->setVersion('4711-08/15')
//    ->setEndDate('2014-10-10 23:59:59')
//    ->setSenderIban('00000')
//    ->setSenderBic('SKGIDE5FXXX')
//    ->setSenderCountryCode('de')
;

//echo '<pre>' . print_r($SofortBillcode, true) . '</pre>';

$SofortLibBillcode->createBillcode();

if($SofortLibBillcode->isError()) {
    // SOFORT-API didn't accept the data
    echo $SofortLibBillcode->getError();
} else {
    // Retrieve Billcode or Billcode URL
    echo $SofortLibBillcode->getBillcode();
    echo '<br/>';
    echo $SofortLibBillcode->getBillcodeUrl();

    //echo '<pre>' . print_r($SofortLibBillcode, true) . '</pre>';
}
