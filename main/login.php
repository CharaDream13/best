<?php
require_once "../header_and_footer/header.php";
require_once "../header_and_footer/aside1.php";
?>
<div class="site_content">
    <div class="container">
        <h1>Вход в Аккаунт</h1>
        <div class="container_flex">
            <img src="../media/front_pogruz3.png">
            <div>
                <form action="../code/login.php" method="POST">
                    <div class="container_reg">
                        <label for="login_or_email_or_phone">Логин:</label>
                        <input type="text" id="login_or_email_or_phone" name="login_or_email_or_phone"
                            placeholder="Логин или Почта или Номер телефона">
                    </div>
                    <div class="container_reg">
                        <label for="password">Пароль:</label>
                        <input type="password" name="password" placeholder="Пароль">
                    </div>
                    <input type="submit" value="Войти">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once "../header_and_footer/aside2.php";
require_once "../header_and_footer/footer.php";
?>