<?php
namespace Sofort\SofortLib;

require __DIR__ . '/../vendor/autoload.php';

// Enter your configuration key.
// You only can create a new configuration key by creating a new Gateway project in your account at sofort.com
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

$SofortLibBillcode->createBillcode();

if($SofortLibBillcode->isError()) {
    // SOFORT-API didn't accept the data
    echo $SofortLibBillcode->getError();
} else {
    // Retrieve Paycode or Paycode URL
    require_once(dirname(__FILE__) . '/../src/BillcodeDetails.php');

    $SofortLibBillcodeDetails = new BillcodeDetails($configkey);

    $SofortLibBillcodeDetails->setBillcode($SofortLibBillcode->getBillcode());

    $SofortLibBillcodeDetails->sendRequest();

    echo $SofortLibBillcodeDetails->getStatus().'<br/>';
    echo $SofortLibBillcodeDetails->getProjectId().'<br/>';
    echo $SofortLibBillcodeDetails->getTransaction().'<br/>';
    echo $SofortLibBillcodeDetails->getAmount().'<br/>';
    echo $SofortLibBillcodeDetails->getReason().'<br/>';
    echo $SofortLibBillcodeDetails->getReason(0).'<br/>';
    echo $SofortLibBillcodeDetails->getReason(1).'<br/>';
    echo $SofortLibBillcodeDetails->getTimeCreated().'<br/>';
    echo $SofortLibBillcodeDetails->getStartDate().'<br/>';
    echo $SofortLibBillcodeDetails->getTimeUsed().'<br/>';
    echo $SofortLibBillcodeDetails->getEndDate().'<br/>';
    echo $SofortLibBillcodeDetails->getCurrencyCode().'<br/>';
    echo $SofortLibBillcodeDetails->getLanguageCode().'<br/>';
    echo $SofortLibBillcodeDetails->getSenderBankCode().'<br/>';
    echo $SofortLibBillcodeDetails->getSenderCountryCode().'<br/>';
    echo $SofortLibBillcodeDetails->getSenderBic().'<br/>';
    echo $SofortLibBillcodeDetails->getUserVariable().'<br/>';
    echo $SofortLibBillcodeDetails->getUserVariable(0).'<br/>';

    //echo '<pre>' . print_r($SofortLibBillcodeDetails, true) . '</pre>';
}