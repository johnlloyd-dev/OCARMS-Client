<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

session_start();

require './autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AcxPJVX1l2GCdcgwkEsfuXlytlq6faGRMI75pIMQbtyhgDvi5WZZUitAWnUnUTm6gcAYqIL7HXmz0KnB',
    'client_secret' => 'EFe5vN18UEbjK33sZsPHg1pZufrHntu6MB23rkcrwUeqg4U6nsMksG61VH8vXj2fo7R2S2gaQOG_6lYW',
    'return_url' => 'http://localhost/OCARMS%20Client/paypal_payment/response.php',
    'cancel_url' => 'http://localhost/OCARMS%20Client/paypal_payment/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'ocarms_system'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
