<?php
require_once "../code/db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login_or_email_or_phone = $_POST["login_or_email_or_phone"];
    $password = $_POST["password"];
    $stmt = $connect->prepare("SELECT id_user, login, phone, email, first_name, last_name, patronymic, password, id_rule FROM Users WHERE login = ? OR phone = ? OR email = ?");
    $stmt->bind_param("sss", $login_or_email_or_phone, $login_or_email_or_phone, $login_or_email_or_phone);
    $stmt->execute();
    $stmt->bind_result($id_user, $login, $phone, $email, $first_name, $last_name, $patronymic, $password_confirm, $id_rule);
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if ($password === $password_confirm) {
            $_SESSION["id_user"] = $id_user;
            $_SESSION['login'] = $login;
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['patronymic'] = $patronymic;
            $_SESSION['phone'] = $phone;
            $_SESSION['id_rule'] = $id_rule;
        }
    }
}
header("Location: ../main/lk.php");
?>