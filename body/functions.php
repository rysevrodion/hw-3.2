<?php

function searchId($email) // Функция ищет пользователя по почте, возвращает всю информацию в виде массива
{
    $connect = new mysqli('127.0.0.1', 'root', '', 'users', '3306');
    $result = $connect->query("SELECT * FROM users WHERE email = '$email';");
    $data = $result->fetch_all();
    if(empty($data)){
        return null;
    } else {
        return $data;
    }
}

function newUser($name, $address, $email) // Функция записывает в бд нового пользователя, возвращает id заказа
{
    date_default_timezone_set('Etc/GMT-7'); // Привидение времени под мой часовой пояс
    $connect = new mysqli('127.0.0.1', 'root', '', 'users', '3306');
    $Id = uniqid();
    $dateOfOrder = date('Y.m.d H:i:s' );
    $connect->query("INSERT INTO users (`id`, `name`, `address`, `email`, `order_count`, `order_id`, `dateOfOrder`)
                                VALUES ('','$name','$address','$email',1,'$Id','$dateOfOrder');"
    );
    return $Id;
}

function oldUser($address, $orderCount, $email) // Функция обновляет данные уже существующего пользователя: адрес, т.к считаю, что он может меняться, id заказа, счетик заказов
{
    date_default_timezone_set('Etc/GMT-7');
    $connect = new mysqli('127.0.0.1', 'root', '', 'users', '3306');
    $Id = uniqid();
    $dateOfOrder = date('Y.m.d H:i:s' );
    $connect->query("UPDATE users SET `address`='$address',`order_count`='$orderCount',`order_id`='$Id',`dateOfOrder`='$dateOfOrder' WHERE email = '$email';");
    return $Id;
}

?>