<?php
require 'functions.php';

$name = $_GET['name'];
$phone = $_GET['phone'];
$email = $_GET['email'];

if ($name == '' || $phone == '' || $email == '' || $_GET['street'] == '' || $_GET['house'] == '') {
    echo "Вы не заполнили данные для формирования заказа";
} else {
    $address = "Улица-" . $_GET['street'] . " Дом-" . $_GET['house'];

    if ($_GET['building'] != '') {
        $address .= " Строение-" . $_GET['building'];
    }
    if ($_GET['apartment'] != '') {
        $address .= " Квартира-" . $_GET['apartment'];
    }
    if ($_GET['floor'] != '') {
        $address .= " Этаж-" . $_GET['floor'];
    }
    $data = searchId($email)[0];

    $id = $data[0];

    if($id == null){
        $hash = newUser($name, $address ,$email);
        echo "Спасибо, ваш заказ будет доставлен по адресу: " . $address;
        echo "Номер вашего заказа: " . $hash;
        echo "Это ваш первый заказ!";

    } else {
        if($name != $data[1]){
            echo "К сожалению пользователь с таким email, но другим именем уже существует";
        } else {
            $orderCount = $data[4] + 1;
            $hash = oldUser($address, $orderCount, $email);
            echo "Спасибо, ваш заказ будет доставлен по адресу: " . $address;
            echo " Номер вашего заказа: " . $hash;
            echo " Это ваш $orderCount-й заказ!";
        }
    }
}

?>