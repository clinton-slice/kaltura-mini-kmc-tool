<?php

// Set Kaltura related globals
$partnerId = '';
$adminSecret = '';
$serviceURL= 'https://www.kaltura.com';
$userId = '';

// Instantiate new Kaltura Configruation
$config = new KalturaConfiguration($partnerId);
$config->serviceUrl = $serviceURL;

// Create a new client
$client = new KalturaClient($config);
$ks = $client->generateSession($adminSecret, $userId, KalturaSessionType::ADMIN, $partnerId);
$client->setKs($ks);

?>