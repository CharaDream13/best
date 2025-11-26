<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "SE";
$connect = new mysqli($host, $user, $pass, $db);
if ($connect) {
    mysqli_set_charset($connect, "utf8");
}
if ($connect->connect_error) {
    die("Проблема подключения: " . $connect->connect_error);
}
session_start();
?>