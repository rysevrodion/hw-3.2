<?php
$connect = new mysqli('127.0.0.1', 'root', '', 'users', '3306');

if (mysqli_connect_errno()) {
    echo 'Connection error ' . mysqli_connect_error();
    die;
}
?>