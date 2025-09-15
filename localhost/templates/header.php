<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="/">Главная</a>
        <?php
            if(isset($_SESSION["id_user"])){
                echo   "<a href='/lk.php'>Личный кабинет</a>
                        <a href='/vendor/logout.php'>Выход</a>";
            }else{
                echo   "<a href='/login.php'>Авторизация</a>
                        <a href='/register.php'>Регистрация</a>";
            }
        ?>
    </header>