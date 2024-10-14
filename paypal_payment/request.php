<?php
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;

session_start();

require 'config.php';

$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

if (empty($_POST['item_number'])) {
    throw new Exception('This script should not be called directly, expected post data');
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set some example data for the payment.
$currency = 'PHP';
$item_qty = 1;
$amountPayable = $_POST['total_amount'];
$product_name = $_POST['fundraise_name'];

$_SESSION['id'] = $_POST['donation_id'];
$client_id = $_SESSION['client_id'];

$fetch = mysqli_query($db, "SELECT * FROM client_information WHERE client_id = $client_id");
$row = mysqli_fetch_array($fetch);

if(isset($_POST['account_fname']) && isset($_POST['contact_number']) && isset($_POST['gender']) && isset($_POST['account_lname'])){
    $account_fname = $_POST['account_fname'];
    $account_lname = $_POST['account_lname'];
    $full_name = "$account_fname $account_lname";
    $contact_number = $_POST['contact_number'];
    $gender = $_POST['gender'];
    $profile_display = $full_name;
}else{
    $account_fname = $row['client_fname'];
    $account_lname = $row['client_lname'];
    $contact_number = $row['client_contact_number'];
    $gender = $row['client_gender'];
    $profile_display = "Anonymous";
}

$b_date = $_POST['birth_date'];


$_SESSION['account_fname'] = $account_fname;
$_SESSION['account_lname'] = $account_lname;
$_SESSION['contact_number'] = $contact_number;
$_SESSION['gender'] = $gender;
$_SESSION['b_date'] = $b_date;
$_SESSION['profile_display'] = $profile_display;

$item_code = rand(1000000000, 10000000000);
$description = 'Paypal Transaction';
$invoiceNumber = uniqid();

$my_items = array(
	array('name'=> $product_name, 'quantity'=> $item_qty, 'price'=> $amountPayable, 'sku'=> $item_code, 'currency'=> $currency)
);
	
$amount = new Amount();
$amount->setCurrency($currency)
    ->setTotal($amountPayable);

$items = new ItemList();
$items->setItems($my_items);
	
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription($description)
    ->setInvoiceNumber($invoiceNumber)
	->setItemList($items);

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
} catch (Exception $e) {
    throw new Exception('Unable to create link for payment');
}

header('location:' . $payment->getApprovalLink());
exit(1);