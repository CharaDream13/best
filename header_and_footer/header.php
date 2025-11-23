<?php require_once "../code/db.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СпецТехАренда</title>
</head>
<?php require_once "../code/all.php"; ?>
<body>
    <header>
        <div class="logo_box">
            <img src="../media/logo.png" class="logo">
            <h2 class="logo_text">СпецТехАренда</h2>
        </div>
        <ul class="link_menu">
            <li><a href="../main/about_us.php" class="link">О нас</a></li>
            <li><a href="../main/catalog.php" class="link">Каталог спецтехники</a></li>
            <li><a href="../main/conditions.php" class="link">Условие аренды</a></li>
            <li><a href="../main/where_to_find.php" class="link">Где найти</a></li>
            <?php if(!isset($_SESSION["id_user"])){
                echo   '<li><a href="../main/login.php" class="link">Вход</a></li>
                        <li><a href="../main/register.php" class="link">Регистрация</a></li>';
            }else{
                echo   '<li><a href="../main/lk.php" class="link">Личный кабинет</a></li>
                       <li><a href="../code/logout.php" class="link">Выход</a></li>';
            }
            if($_SESSION['id_rule']==1){
                echo   '<li><a href="../main/admin.php" class="link">Админ панель</a></li>';
            }
            ?>
        </ul>
    </header>