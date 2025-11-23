<?php
require_once "../code/db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $patronymic = isset($_POST["patronymic"]) ? $_POST["patronymic"] : 0;
    $password = $_POST["password"];
    $password_confirm = $_POST["passwordConfirm"];
    $id_rule = "2";
    if ($password == $password_confirm) {
        $stmt = $connect->prepare("SELECT id_user FROM Users WHERE login = ? OR phone = ? OR email = ?");
        $stmt->bind_param("sss", $login, $phone, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
            $stmt = $connect->prepare("INSERT INTO Users(login, phone, email, password, first_name, last_name, patronymic, id_rule) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssss', $login, $phone, $email, $password, $first_name, $last_name, $patronymic, $id_rule);
            $stmt->execute();
            $stmt->close();
        }
    }
}
header("Location: ../main/login.php");
?>