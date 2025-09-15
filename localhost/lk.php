<?php 
    require_once 'templates/header.php' 
    if(!isset($_SESSION["id_user"])){
        header("Location: /login.php");
    }
?>
    <main>
        <div>Ваш ID: <?=$_SESSION["id_user"]?></div>
        <div>Ваше имя: <?=$_SESSION["name"]?></div>
        <div>Ваш логин: <?=$_SESSION["login"]?></div>
    </main>
<?php require_once 'templates/footer.php' ?>