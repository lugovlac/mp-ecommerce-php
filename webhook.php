<?php
	require_once 'vendor/autoload.php';

    MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398");
    MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");    

    http_response_code(200);

    switch($_POST["type"]) {
        case "payment":
            $data = MercadoPago\Payment.find_by_id($_POST["id"]);
            break;
        case "plan":
            $data = MercadoPago\Plan.find_by_id($_POST["id"]);
            break;
        case "subscription":
            $data = MercadoPago\Subscription.find_by_id($_POST["id"]);
            break;
        case "invoice":
            $data = MercadoPago\Invoice.find_by_id($_POST["id"]);
            break;
    }

	$webhTxt = "webhook_".$_POST['date_created'].".txt";
	$paymentTxt = "payment_".$_POST['date_created'].".txt";

	$json = file_get_contents('php://input');

	//webhook txt
	file_put_contents($webhTxt, $json);

	//payment data txt
	file_put_contents($paymentTxt, $data);
?>