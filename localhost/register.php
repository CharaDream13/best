<?php require_once 'templates/header.php' ?>
    <main>
        <form action="/vendor/createuser.php" method="post">
            <input type="text" placeholder="Имя" name="name" required>
            <input type="text" placeholder="Логин" name="login" required>
            <input type="password" placeholder="Пароль" name="password" required>
            <input type="submit" value="Регистрация">
        </form>
        <div>
            <?php
                if(isset($_SESSION["msg"])){
                    echo $_SESSION["msg"];
                    unset($_SESSION["msg"]);
                }
            ?>
        </div>
    </main>
<?php require_once 'templates/footer.php' ?>