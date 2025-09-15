<?php
    session_start();
    require_once "../functions.php"
    $name = validate($_POST["name"]);
    $login = validate($_POST["login"]);
    $password = validate($_POST["password"]);
    $checkuser = query("SELECT id_user FROM 'user' WHERE login = ?",[$login]);
    if(count($checkuser)>0){
        $_SESSION["msg"]="Логин занят";
        header("Location: /register.php");
    }else{
        make("INSERT INTO 'user'('name','login','password') VALUES (?, ?, ?)", [$name, $login, $password]);
        header("Location: /login.php");
    }