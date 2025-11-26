<?php
if (isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}
require_once '../code/db.php';
$current_user_id = $_SESSION['id_user'];
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = 4;
$offset = ($page - 1) * $per_page;
$sql = "SELECT Rent.id_rent, Rent.price AS rent_price, Rent.date, Rent.time, Rent.id_status, Products.name_product, Products.photo 
        FROM Rent 
        JOIN Products ON Rent.id_product = Products.id_product 
        WHERE Rent.id_user = ? 
        ORDER BY Rent.date DESC 
        LIMIT ?, ?";
$stmt = $connect->prepare($sql);
if ($stmt === false) {
    die('Ошибка подготовки запроса аренды: ' . $connect->error);
}
$stmt->bind_param('iii', $current_user_id, $offset, $per_page);
$stmt->execute();
$rent_items = array();
$stmt->bind_result($rent_id, $rent_price, $rent_date, $rent_time, $rent_status, $product_name, $product_photo);
while ($stmt->fetch()) {
    $rent_items[] = array(
        'id_rent' => $rent_id,
        'rent_price' => $rent_price,
        'date' => $rent_date,
        'time' => $rent_time,
        'id_status' => $rent_status,
        'name_product' => $product_name,
        'photo' => $product_photo
    );
}
$stmt->close();
$count_sql = "SELECT COUNT(*) FROM Rent WHERE id_user = ?";
$count_stmt = $connect->prepare($count_sql);
if ($count_stmt === false) {
    die('Ошибка подготовки запроса счетчика: ' . $connect->error);
}
$count_stmt->bind_param('i', $current_user_id);
$count_stmt->execute();
$total_count = 0;
$count_stmt->bind_result($total_count);
$count_stmt->fetch();
$count_stmt->close();
$total_pages = max(1, ceil($total_count / $per_page));
require_once '../header_and_footer/header.php';
require_once '../header_and_footer/aside1.php';
?>
<div class="site_content">
    <div class="container">
        <div class="container_lk">
            <img src="../media/prem/ben-1.svg" alt="User Avatar">
            <div>
                <h1>Ваши данные</h1>
                <p>Логин: <?= htmlspecialchars($_SESSION['login']) ?></p>
                <p>Почта: <?= htmlspecialchars($_SESSION['email']) ?></p>
                <p>Имя: <?= htmlspecialchars($_SESSION['first_name']) ?></p>
                <p>Фамилия: <?= htmlspecialchars($_SESSION['last_name']) ?></p>
                <p>Отчество: <?= htmlspecialchars($_SESSION['patronymic']) ?></p>
                <p>Номер телефона: <?= htmlspecialchars($_SESSION['phone']) ?></p>
            </div>
        </div>
        <hr>
        <h2>История аренд</h2>
        <div class="container_catalog">
            <?php if (count($rent_items) > 0): ?>
                <?php foreach ($rent_items as $row): ?>
                    <article class="card">
                        <h2><?= htmlspecialchars($row['name_product']) ?></h2>
                        <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Фото товара">
                        <div class="container_flex">
                            <div>
                                <p>Цена аренды: <?= htmlspecialchars($row['rent_price']) ?> ₽</p>
                                <p>Дата: <?= htmlspecialchars($row['date']) ?></p>
                                <p>Длительность: <?= htmlspecialchars($row['time']) ?> ч</p>
                                <p>Статус:
                                    <?php
                                    switch ($row['id_status']) {
                                        case 1:
                                            echo "заявка открытая";
                                            break;
                                        case 2:
                                            echo "заявка закрыта";
                                            break;
                                    }
                                    ?>
                                </p>
                            </div>
                            <?php if ($row['id_status'] > 1): ?>
                                <a href="reviews.php?id_rent=<?= urlencode($row['id_rent']) ?>" class="button">Хотите оставить
                                    отзыв?</a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>У вас не было аренд</p>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a class="button" href="?page=1">Первая</a>
                <a class="button" href="?page=<?= $page - 1 ?>">Назад</a>
            <?php endif; ?>
            <span>Страница <?= $page ?> из <?= $total_pages ?></span>
            <?php if ($page < $total_pages): ?>
                <a class="button" href="?page=<?= $page + 1 ?>">Вперёд</a>
                <a class="button" href="?page=<?= $total_pages ?>">Последняя</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
require_once '../header_and_footer/aside2.php';
require_once '../header_and_footer/footer.php';
?>