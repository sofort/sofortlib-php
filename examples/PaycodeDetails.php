<?php
namespace Sofort\SofortLib;

require __DIR__ . '/../vendor/autoload.php';

// Enter your configuration key.
// You only can create a new configuration key by creating a new Gateway project in your account at sofort.com
$configkey = '12345:123456:edc788a4316ce7e2ac0ede037aa623d7';

$SofortLibPaycode = new Paycode($configkey);

$SofortLibPaycode->setAmount(5.55)
//    ->setLanguageCode('de')
//    ->setVersion('4711-08/15')
//    ->setEndDate('2014-10-10 23:59:59')
    ->setCurrencyCode('EUR')
//    ->setSenderBankCode('00000')
//    ->setSenderIban('00000')
//    ->setSenderBic('SKGIDE5FXXX')
//    ->setSenderCountryCode('de')
    ->setReason('Reason Line 1', 'Reason Line 2')
    ->setSuccessUrl('http://www.google.de')
    ->setSuccessLinkRedirect(0)
    ->setAbortUrl('http://www.sofort.com')
    ->setNotificationUrl('http://www.diesundjenes.de/notify')
    ->setUserVariable('schwuppsen');

$SofortLibPaycode->createPaycode();

if($SofortLibPaycode->isError()) {
    // SOFORT-API didn't accept the data
    echo $SofortLibPaycode->getError();
} else {
    // Retrieve Paycode or Paycode URL
    $SofortPaycodeDetails = new PaycodeDetails($configkey);

    $SofortPaycodeDetails->setPaycode($SofortLibPaycode->getPaycode());

    $SofortPaycodeDetails->sendRequest();

    echo $SofortPaycodeDetails->getStatus().'<br/>';
    echo $SofortPaycodeDetails->getProjectId().'<br/>';
    echo $SofortPaycodeDetails->getTransaction().'<br/>';
    echo $SofortPaycodeDetails->getAmount().'<br/>';
    echo $SofortPaycodeDetails->getReason().'<br/>';
    echo $SofortPaycodeDetails->getReason(0).'<br/>';
    echo $SofortPaycodeDetails->getReason(1).'<br/>';
    echo $SofortPaycodeDetails->getStartDate().'<br/>';
    echo $SofortPaycodeDetails->getTimeCreated().'<br/>';
    echo $SofortPaycodeDetails->getTimeUsed().'<br/>';
    echo $SofortPaycodeDetails->getEndDate().'<br/>';
    echo $SofortPaycodeDetails->getCurrencyCode().'<br/>';
    echo $SofortPaycodeDetails->getLanguageCode().'<br/>';
    echo $SofortPaycodeDetails->getSenderBankCode().'<br/>';
    echo $SofortPaycodeDetails->getSenderCountryCode().'<br/>';
    echo $SofortPaycodeDetails->getSenderBic().'<br/>';
    echo $SofortPaycodeDetails->getUserVariable().'<br/>';
    echo $SofortPaycodeDetails->getUserVariable(0).'<br/>';

    //echo '<pre>' . print_r($SofortPaycodeDetails, true) . '</pre>';
}