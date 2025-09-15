<?php require_once 'templates/header.php' ?>
    <main>
        <form action="/vendor/auth.php" method="post">
            <input type="text" placeholder="Логин" name="login" required>
            <input type="password" placeholder="Пароль" name="password" required>
            <input type="submit" value="Вход">
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