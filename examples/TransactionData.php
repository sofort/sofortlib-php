<?php
namespace Sofort\SofortLib;

require __DIR__ . '/../vendor/autoload.php';

// Enter your configuration key.
// You only can create a new configuration key by creating a new Gateway project in your account at sofort.com
$configkey = '12345:123456:edc788a4316ce7e2ac0ede037aa623d7';

// read the notification from php://input  (http://php.net/manual/en/wrappers.php.php)
// this class should be used as a callback function
$SofortLib_Notification = new Notification();

$TestNotification = $SofortLib_Notification->getNotification(file_get_contents('php://input'));

//echo $SofortLib_Notification->getTransactionId();
//echo '<br />';
//echo $SofortLib_Notification->getTime();
//echo '<br />';

$SofortLibTransactionData = new TransactionData($configkey);

// If SofortLib_Notification returns a transaction_id:
$SofortLibTransactionData->addTransaction($TestNotification);

//$SofortLibTransactionData->addTransaction(array('00907-01222-50F00112-D86E', '00907-01222-50EFFC79-7E33'));
//$SofortLibTransactionData->addTransaction(array('00907-37660-51D2CD5E-8182'));
//$SofortLibTransactionData->addTransaction('00907-01222-51ADD8C9-86C8');

// By default without setter Api version 1.0 will be used due to backward compatibility, please set ApiVersion to
// latest version. Please note that the response might have a different structure and values For more details please
// see our Api documentation on https://www.sofort.com/integrationCenter-ger-DE/integration/API-SDK/
$SofortLibTransactionData->setApiVersion('2.0');

//$SofortLibTransactionData->setTime('2012-11-14T18:00+02:00', '2012-12-13T00:00+02:00');
//$SofortLibTransactionData->setNumber(5, 1);

$SofortLibTransactionData->sendRequest();


$output = array();
$methods = array(
    'getAmount' => '',
    'getAmountRefunded' => '',
    'getCount' => '',
    'getPaymentMethod' => '',
    'getConsumerProtection' => '',
    'getStatus' => '',
    'getStatusReason' => '',
    'getStatusModifiedTime' => '',
    'getLanguageCode' => '',
    'getCurrency' => '',
    'getTransaction' => '',
    'getReason' => array(0,0),
    'getUserVariable' => 0,
    'getTime' => '',
    'getProjectId' => '',
    'getRecipientHolder' => '',
    'getRecipientAccountNumber' => '',
    'getRecipientBankCode' => '',
    'getRecipientCountryCode' => '',
    'getRecipientBankName' => '',
    'getRecipientBic' => '',
    'getRecipientIban' => '',
    'getSenderHolder' => '',
    'getSenderAccountNumber' => '',
    'getSenderBankCode' => '',
    'getSenderCountryCode' => '',
    'getSenderBankName' => '',
    'getSenderBic' => '',
    'getSenderIban' => '',
);

foreach($methods as $method => $params) {
    if(count($params) == 2) {
        $output[] = $method . ': ' . $SofortLibTransactionData->$method($params[0], $params[1]);
    } else if($params !== '') {
        $output[] = $method . ': ' . $SofortLibTransactionData->$method($params);
    } else {
        $output[] = $method . ': ' . $SofortLibTransactionData->$method();
    }
}

if($SofortLibTransactionData->isError()) {
    echo $SofortLibTransactionData->getError();
} else {
    echo implode('<br />', $output);
}
