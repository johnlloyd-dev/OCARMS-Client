<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

session_start();

require 'config.php';

if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the paymentId and PayerID');
}

$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {
    // Take the payment
    $payment->execute($execution, $apiContext);

    try {
        $db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

        $payment = Payment::get($paymentId, $apiContext);

        $data = [
            'product_id' => $payment->transactions[0]->item_list->items[0]->sku,
            'transaction_id' => $payment->getId(),
            'payment_amount' => $payment->transactions[0]->amount->total,
            'currency_code' => $payment->transactions[0]->amount->currency,
            'payment_status' => $payment->getState(),
            'invoice_id' => $payment->transactions[0]->invoice_number,
            'product_name' => $payment->transactions[0]->item_list->items[0]->name,
			'description' => $payment->transactions[0]->description,
            'client_id' => $_SESSION['client_id'],
            'fundraise_id' => $_SESSION['fundraise_id'],
            'profile_display' => $_SESSION['profile_display'],
        ];
        if (addPayment($data) !== false && $data['payment_status'] === 'approved') {
            // Payment successfully added, redirect to the payment complete page.
			$inserids =$db->insert_id;
            $client_id = $_SESSION['client_id'];
            foreach($_SESSION['id'] as $key => $value){
                $pizza = explode(",", $value);
                foreach($pizza as $key2 => $value2){
                    mysqli_query($db, "UPDATE monetary_donation_info SET donation_id = '".$value2."', donation_status = '"."Donated"."', donation_method = '"."PayPal"."' WHERE donation_id = '".$value2."'");
                }
            }

            $account_fname = $_SESSION['account_fname'];
            $account_lname = $_SESSION['account_lname'];
            $account_name = "$account_fname $account_lname"; 
            $contact_number = $_SESSION['contact_number'];
            $gender = $_SESSION['gender'];
            $b_date = $_SESSION['b_date'];

            mysqli_query($db, "UPDATE client_information SET client_id = '$client_id', client_name = '$account_name', client_fname = '$account_fname', client_lname = '$account_lname', client_contact_number = '$contact_number', client_gender = '$gender', client_birth_date = '$b_date' WHERE client_id = '$client_id'");
            mysqli_query($db, "INSERT INTO alerts_center (alert_message, alert_link, alert_status, alert_identifier) VALUES ('$account_name added a monetary donation!', 'summary_table_monetary.php', 'Unread', '$client_id')");

            header("location:http://localhost/OCARMS%20Client/paypal_success.php?payid=$inserids");
            exit(1);
        } else {
            // Payment failed
			header("location:http://localhost/OCARMS%20Client/paypal_payment/PaypalFailed.php");
             exit(1);
        }

    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal

    }

} catch (Exception $e) {
    // Failed to take payment

}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($data)
{
    global $db;

    if (is_array($data)) {
        $stmt = $db->prepare('INSERT INTO `payments` (product_id, transaction_id, payment_amount, currency_code, payment_status, invoice_id, product_name, createdtime, fundraise_id, client_id, profile_display) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'isdsssssiis',
            $data['product_id'],
            $data['transaction_id'],
            $data['payment_amount'],
            $data['currency_code'],
            $data['payment_status'],
            $data['invoice_id'],
            $data['product_name'],
            date('Y-m-d H:i:s'),
            $data['fundraise_id'],
            $data['client_id'],
            $data['profile_display'],
        );
        $stmt->execute();
        $stmt->close();
		
        return $db->insert_id;


    }
    return false;  
    unset($_SESSION['account_fname']);
    unset($_SESSION['account_lname']);
    unset($_SESSION['contact_number']);
    unset($_SESSION['gender']);
    unset($_SESSION['b_date']);
    unset($_SESSION['profile_display']);
    unset($_SESSION['id']);


}


