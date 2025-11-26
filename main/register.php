<?php
require_once "../header_and_footer/header.php";
require_once "../header_and_footer/aside1.php";
?>
<div class="site_content">
    <div class="container">
        <h1>Регистрация Аккаунта</h1>
        <form action="../code/register.php" method="POST" class="container_flex">
            <div>
                <div class="container_reg">
                    <label for="login">Логин:</label>
                    <input type="text" id="login" name="login" placeholder="Логин" pattern="^[a-zA-Z0-9-]{3,}$"
                        required>
                </div>
                <div class="container_reg">
                    <label for="email">Почта:</label>
                    <input type="email" id="email" name="email" placeholder="Почта"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                </div>
                <div class="container_reg">
                    <label for="phone">Номер телефона:</label>
                    <input type="text" id="phone" name="phone" placeholder="Номер телефона"
                        pattern="^(8|\+7)[\s\-]?\(?\d{3}\)?[\s\-]?\d{3}[\s\-]?\d{2}[\s\-]?\d{2}$" required>
                </div>
                <div class="container_reg">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Имя" pattern="^[а-яА-ЯёЁ -]+$"
                        required>
                </div>
                <div class="container_reg">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Фамилия" pattern="^[а-яА-ЯёЁ -]+$"
                        required>
                </div>
                <div class="container_reg">
                    <label for="patronymic">Отчество:</label>
                    <input type="text" id="patronymic" name="patronymic" placeholder="Отчество"
                        pattern="^[а-яА-ЯёЁ -]+$">
                </div>
                <div class="container_reg">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" placeholder="Пароль"
                        pattern="^[a-zA-Z0-9-]{6,}$" required>
                </div>
                <div class="container_reg">
                    <label for="passwordConfirm">Повторите пароль:</label>
                    <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Повторите пароль"
                        pattern="^[a-zA-Z0-9-]{6,}$" required>
                </div>
                <div class="container_reg">
                    <label for="checkbox">Согласие с <a href="conditions.php">условием аренды</a></label>
                    <input type="checkbox" name="checkbox" id="checkbox" required>
                </div>
                <input type="submit" value="Зарегистрироваться">
            </div>
            <img src="../media/koles_2.png">
        </form>
    </div>
</div>
<?php
require_once "../header_and_footer/aside2.php";
require_once "../header_and_footer/footer.php";
?>