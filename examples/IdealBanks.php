<?php
namespace Sofort\SofortLib;

require __DIR__ . '/../vendor/autoload.php';

// Enter your configuration key.
// You only can create a new configuration key by creating a new Gateway project in your account at sofort.com
$SofortLibIdealBanks = new IdealBanks('12345:123456:edc788a4316ce7e2ac0ede037aa623d7');

$SofortLibIdealBanks->sendRequest();

print_r($SofortLibIdealBanks->getBanks());
