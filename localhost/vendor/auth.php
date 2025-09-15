<?php
    session_start();
    require_once "../function.php";
    $login = validate($_POST["login"]);
    $password = validate($_POST["password"]);
    $user = query("SELECT id_user, name, login FROM user WHERE login = ? AND password = ?", [$login, $password]);
    if (count($user)>0){
        $info = $user[0];
        $_SESSION["id_user"] = $info["id_user"];
        $_SESSION["name"] = $info["name"];
        $_SESSION["login"] = $info["login"];
        header("Location: /lk.php");
    }else{
        $_SESSION["msg"] = "Логин или пароль неверен";
        header("Location: /login.php");
    }