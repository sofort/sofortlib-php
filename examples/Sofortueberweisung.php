<?php
namespace Sofort\SofortLib;

require __DIR__ . '/../vendor/autoload.php';

// Enter your configuration key.
// You only can create a new configuration key by creating a new Gateway project in your account at sofort.com
$configkey = '12345:12345:5dbdad2bc861d907eedfd9528127d002';

$Sofortueberweisung = new Sofortueberweisung($configkey);

$Sofortueberweisung->setAmount(10.21);
$Sofortueberweisung->setCurrencyCode('EUR');
$Sofortueberweisung->setReason('Testueberweisung', 'Verwendungszweck');
$Sofortueberweisung->setSuccessUrl('YOUR_SUCCESS_URL', true); // i.e. http://my.shop/order/success
$Sofortueberweisung->setAbortUrl('YOUR_ABORT_URL');
// $Sofortueberweisung->setSenderSepaAccount('SFRTDE20XXX', 'DE06000000000023456789', 'Max Mustermann');
// $Sofortueberweisung->setSenderCountryCode('DE');
// $Sofortueberweisung->setNotificationUrl('YOUR_NOTIFICATION_URL', 'loss,pending');
// $Sofortueberweisung->setNotificationUrl('YOUR_NOTIFICATION_URL', 'loss');
// $Sofortueberweisung->setNotificationUrl('YOUR_NOTIFICATION_URL', 'pending');
// $Sofortueberweisung->setNotificationUrl('YOUR_NOTIFICATION_URL', 'received');
// $Sofortueberweisung->setNotificationUrl('YOUR_NOTIFICATION_URL', 'refunded');
$Sofortueberweisung->setNotificationUrl('YOUR_NOTIFICATION_URL');
//$Sofortueberweisung->setCustomerprotection(true);


$Sofortueberweisung->sendRequest();

if($Sofortueberweisung->isError()) {
    // SOFORT-API didn't accept the data
    echo $Sofortueberweisung->getError();
} else {
    // get unique transaction-ID useful for check payment status
    $transactionId = $Sofortueberweisung->getTransactionId();
    // buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
    $paymentUrl = $Sofortueberweisung->getPaymentUrl();
    header('Location: '.$paymentUrl);
}

