<?php
require_once "../code/db.php";
$page = isset($_GET["page"]) ? max(1, (int) $_GET["page"]) : 1;
$id_type = isset($_GET["type"]) ? (int) $_GET["type"] : 0;
$min = isset($_GET["min"]) ? (int) $_GET["min"] : 0;
$max = isset($_GET["max"]) ? (int) $_GET["max"] : 3000;
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], array('asc', 'desc'))) ? $_GET['sort'] : '';
$per_page = 4;
$offset = ($page - 1) * $per_page;
$sql = "SELECT id_product, name_product, photo, price, available, id_type FROM Products WHERE price BETWEEN ? AND ?";
$params = array($min, $max);
$types = "ii";
if ($id_type > 0) {
    $sql .= " AND id_type = ?";
    $params[] = $id_type;
    $types .= "i";
}
if ($sort === 'asc' || $sort === 'desc') {
    $sql .= " ORDER BY price " . strtoupper($sort);
}
$sql .= " LIMIT ?, ?";
$params[] = $offset;
$params[] = $per_page;
$types .= "ii";
$stmt = $connect->prepare($sql);
$bind_names = array($types);
for ($i = 0; $i < count($params); $i++) {
    $bind_names[] = &$params[$i];
}
call_user_func_array(array($stmt, 'bind_param'), $bind_names);
$stmt->execute();
$products = array();
$stmt->store_result();
$meta = $stmt->result_metadata();
$fields = array();
while ($field = $meta->fetch_field()) {
    $fields[] = $field->name;
}
$results = array();
$bind_vars = array();
foreach ($fields as $field_name) {
    $results[$field_name] = null;
}
foreach ($fields as $index => $field_name) {
    $bind_vars[] = &$results[$field_name];
}
call_user_func_array(array($stmt, 'bind_result'), $bind_vars);
while ($stmt->fetch()) {
    $row = array();
    foreach ($fields as $field_name) {
        $row[$field_name] = $results[$field_name];
    }
    $products[] = $row;
}
$stmt->close();
$count_sql = "SELECT COUNT(*) FROM Products WHERE price BETWEEN ? AND ?";
$count_params = array($min, $max);
$count_types = "ii";
if ($id_type > 0) {
    $count_sql .= " AND id_type = ?";
    $count_params[] = $id_type;
    $count_types .= "i";
}
$count_stmt = $connect->prepare($count_sql);
$bind_names = array($count_types);
for ($i = 0; $i < count($count_params); $i++) {
    $bind_names[] = &$count_params[$i];
}
call_user_func_array(array($count_stmt, 'bind_param'), $bind_names);
$count_stmt->execute();
$count_stmt->bind_result($total);
$count_stmt->fetch();
$count_stmt->close();
$total_pages = max(1, ceil($total / $per_page));
require_once "../header_and_footer/header.php";
require_once "../header_and_footer/aside1.php";
?>
<div class="site_content">
    <div class="container">
        <form class="filter" method="GET">
            <label>Сортировка по типу:</label>
            <select name="type">
                <option value="0" <?= $id_type == 0 ? 'selected' : '' ?>>Все типы</option>
                <option value="1" <?= $id_type == 1 ? 'selected' : '' ?>>Гусеничные</option>
                <option value="2" <?= $id_type == 2 ? 'selected' : '' ?>>Колесные</option>
                <option value="3" <?= $id_type == 3 ? 'selected' : '' ?>>Мини</option>
                <option value="4" <?= $id_type == 4 ? 'selected' : '' ?>>Погрузчики</option>
            </select>
            <label>Цена от</label>
            <input type="number" name="min" value="<?= $min ?>">
            <label>до</label>
            <input type="number" name="max" value="<?= $max ?>">
            <label>Сортировка по цене:</label>
            <select name="sort">
                <option value="" <?= $sort == '' ? 'selected' : '' ?>>Без сортировки</option>
                <option value="asc" <?= $sort == 'asc' ? 'selected' : '' ?>>По возрастанию</option>
                <option value="desc" <?= $sort == 'desc' ? 'selected' : '' ?>>По убыванию</option>
            </select>
            <input type="submit" value="Найти">
        </form>
        <div class="container_catalog">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $row): ?>
                    <article class="card">
                        <h2><?= $row["name_product"] ?></h2>
                        <img src="<?= $row["photo"] ?>">
                        <div class="container_flex">
                            <div>
                                <p>Цена: <?= $row["price"] ?> ₽/час</p>
                                <p>Свободно для аренды: <?= $row["available"] ?></p>
                            </div>
                            <form action="product.php" method="get">
                                <input type="hidden" name="id" value="<?= $row['id_product'] ?>">
                                <input type="submit" value="Арендовать" class="bye_button">
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Товары не найдены</p>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a class="button"
                    href="?page=1&type=<?= $id_type ?>&min=<?= $min ?>&max=<?= $max ?>&sort=<?= $sort ?>">Первая</a>
                <a class="button"
                    href="?page=<?= $page - 1 ?>&type=<?= $id_type ?>&min=<?= $min ?>&max=<?= $max ?>&sort=<?= $sort ?>">Назад</a>
            <?php endif; ?>
            <span>Страница <?= $page ?> из <?= $total_pages ?></span>
            <?php if ($page < $total_pages): ?>
                <a class="button"
                    href="?page=<?= $page + 1 ?>&type=<?= $id_type ?>&min=<?= $min ?>&max=<?= $max ?>&sort=<?= $sort ?>">Вперёд</a>
                <a class="button"
                    href="?page=<?= $total_pages ?> &type=<?= $id_type ?>&min=<?= $min ?>&max=<?= $max ?>&sort=<?= $sort ?>">Последняя</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
require_once "../header_and_footer/aside2.php";
require_once "../header_and_footer/footer.php";
?>