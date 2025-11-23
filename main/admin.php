<?php
    require_once "../code/db.php";
    if($_SESSION['id_rule']!=1){
        header("Location: about_us.php");
        }
        
    require_once "../header_and_footer/header.php";
    require_once "../header_and_footer/aside1.php";
?>
    <div class="site_content">
        <div class="container">
            <h2>Админ панель</h2>
            <div class="container">
        <h2>Таблица аккаунтов</h2>
        <table>
            <tr>
                <th>ID</th><th>Логин</th><th>Email</th><th>Телефон</th><th>Имя</th><th>Фамилия</th><th>Отчество</th><th>ID Роли</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id_user']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                    <td><?= htmlspecialchars($user['last_name']) ?></td>
                    <td><?= htmlspecialchars($user['patronymic']) ?></td>
                    <td><?= htmlspecialchars($user['id_rule']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form method="POST">
            <button name="create" value="1">Создать аккаунт</button>
        </form>
        <form method="POST">
            <button name="edit" value="1">Редактировать аккаунт</button>
        </form>
        <form method="POST">
            <button name="delete" value="1">Удалить аккаунт</button>
        </form>
    </div>
            <div class="container">
                <h2>Отзывы</h2>
                //осмотр одобрение и удаление не провериных отзывов, и просмотр провереных
            </div>
            <div class="container">
                <h2>Аренды</h2>
                //осмотр всех заказов и возможность отменить аренду с указаной причиной
            </div>
            <div class="container">
                <h2>Техника</h2>
                //осмотр добавление, редактирование и удаление спец техники
            </div>
        </div>
    </div>
<?php
    require_once "../header_and_footer/aside2.php";
    require_once "../header_and_footer/footer.php";
?>