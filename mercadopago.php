<?php

    require_once 'vendor/autoload.php';

    MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398");
    MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");    


    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->id = "1234";
    $item->title = $_POST['title'];
    $item->description = "Dispositivo móvil de Tienda e-commerce";
    $item->picture_url = $_SERVER['HTTP_HOST'].$_POST['img'];
    $item->quantity = 1;
    $item->unit_price = floatval($_POST['price']);    

    // Creo un objeto de comprador (payer)
    $payer = (object)array(
        "name" => "Lalo",
        "surname" => "Landa",
        "email" => "test_user_63274575@testuser.com",
        "phone" => (object)array(
            "area_code" => "11",
            "number" => "22223333"
        ),
        "address" => (object)array(
            "street_name" => "False",
            "street_number" => 123,
            "zip_code" => "1111"
        )
    );

    //Creo un objeto de payment methods
    $payment = (object)array(
        "excluded_payment_methods" => array(
            (object)array(
                "id" => "amex" )            
        ),
        "excluded_payment_types" => array(
            (object)array(
                "id" => "atm" )
        ),
        "installments" => 6
    );

    // echo "<pre>";
    // print_r((object)$payment);
    // echo "</pre>"; 
    // die();

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    $preference->items = array($item);
    $preference->payer = $payer;
    $preference->payment_methods = $payment;
    $preference->external_reference = 'lugovlac@gmail.com';
    $preference->back_urls = (object)array(
        "success" => $_SERVER['HTTP_HOST']."/success.php",
        "pending" => $_SERVER['HTTP_HOST']."/pending.php",
        "failure" => $_SERVER['HTTP_HOST']."/failure.php"
    );
    $preference->auto_return = "approved";
    $preference->notification_url = $_SERVER['HTTP_HOST']."/webhook.php?source_news=webhooks";

    $preference->save();

?>