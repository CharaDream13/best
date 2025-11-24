<?php
require_once "../code/db.php";
if (!isset($_SESSION)) { session_start(); }
if ($_SESSION['id_rule'] != 1) {
    header("Location: about_us.php");
    exit;
}

$recordsPerPage = 8;
$user_table_page = isset($_GET['user_table_page']) ? (int)$_GET['user_table_page'] : 1;
$review_table_page = isset($_GET['review_table_page']) ? (int)$_GET['review_table_page'] : 1;
$rent_table_page = isset($_GET['rent_table_page']) ? (int)$_GET['rent_table_page'] : 1;
$product_table_page = isset($_GET['product_table_page']) ? (int)$_GET['product_table_page'] : 1;

if ($user_table_page < 1) $user_table_page = 1;
if ($review_table_page < 1) $review_table_page = 1;
if ($rent_table_page < 1) $rent_table_page = 1;
if ($product_table_page < 1) $product_table_page = 1;

function isNumericLikeColumn($col) {
    if (preg_match('/(^id_|^id$|_id$|^id|price|available|rating|time$|_count$|qty|quantity)/i', $col)) {
        return true;
    }
    return false;
}

function buildWhereSql($cols, $prefix) {
    global $connect;
    $conds = "";
    $first = true;
    foreach ($cols as $c) {
        $key = $prefix . $c;
        if (isset($_GET[$key]) && $_GET[$key] !== "") {
            $val = trim($_GET[$key]);
            $esc = $connect->real_escape_string($val);
            if (isNumericLikeColumn($c)) {
                $cond = "`$c` = '" . $esc . "'";
            } else {
                $cond = "`$c` LIKE '%" . $esc . "%'";
            }
            if ($first) {
                $conds .= " WHERE " . $cond;
                $first = false;
            } else {
                $conds .= " AND " . $cond;
            }
        }
    }
    return $conds;
}

function fetchRowsPaged($connect, $table, $cols, $page, $recordsPerPage, $prefix = '') {
    $where = buildWhereSql($cols, $prefix);

    $sql_count = "SELECT COUNT(*) AS total FROM `$table`" . $where;
    $res = $connect->query($sql_count);
    $total = 0;
    if ($res) {
        $row = $res->fetch_assoc();
        $total = isset($row['total']) ? (int)$row['total'] : 0;
    }

    $total_pages = ($total > 0) ? ceil($total / $recordsPerPage) : 1;
    if ($page < 1) $page = 1;
    if ($page > $total_pages) $page = $total_pages;
    $offset = ($page - 1) * $recordsPerPage;

    $colList = "";
    $firstc = true;
    foreach ($cols as $c) {
        if ($firstc) {
            $colList .= "`$c`";
            $firstc = false;
        } else {
            $colList .= ", `$c`";
        }
    }
    $sql_sel = "SELECT " . $colList . " FROM `$table`" . $where . " LIMIT " . (int)$recordsPerPage . " OFFSET " . (int)$offset;
    $res2 = $connect->query($sql_sel);
    $rows = array();
    if ($res2) {
        while ($r = $res2->fetch_assoc()) {
            $rows[] = $r;
        }
    }

    return array('rows' => $rows, 'total_pages' => $total_pages, 'page' => $page, 'total' => $total);
}

$users_cols = array('id_user','login','email','phone','first_name','last_name','patronymic','id_rule');
$reviews_cols = array('id_review','id_user','id_rent','rating','comment','date','show_first_name','show_last_name','show_patronymic','show_login','id_moder_status');
$rents_cols = array('id_rent','id_user','id_product','price','date','time','id_status');
$products_cols = array('id_product','name_product','photo','price','weight','bucket_volume','digging_depth','engine_power','dimensions','speed','available','id_type');

$users_data = fetchRowsPaged($connect, 'users', $users_cols, $user_table_page, $recordsPerPage, 'users_');
$reviews_data = fetchRowsPaged($connect, 'reviews', $reviews_cols, $review_table_page, $recordsPerPage, 'reviews_');
$rents_data = fetchRowsPaged($connect, 'rent', $rents_cols, $rent_table_page, $recordsPerPage, 'rent_');
$products_data = fetchRowsPaged($connect, 'products', $products_cols, $product_table_page, $recordsPerPage, 'products_');

require_once "../header_and_footer/header.php";
require_once "../header_and_footer/aside1.php";
?>
<div class="site_content">
    <div class="container">
        <h2>Админ панель</h2>

        <h2>Аккаунты</h2>
        <?php if (!empty($users_data['rows'])): ?>
            <table>
                <tr>
                    <?php foreach ($users_cols as $c): ?>
                        <th><?= htmlspecialchars($c) ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($users_data['rows'] as $user): ?>
                    <tr>
                        <?php foreach ($users_cols as $c): ?>
                            <td><?= htmlspecialchars($user[$c]) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Нет данных для отображения.</p>
        <?php endif; ?>

        <div class="pagination">
            <?php if ($users_data['page'] > 1): ?>
                <a class="button" href="?user_table_page=1<?= (isset($_GET['product_product'])? '&product_product='.urlencode($_GET['product_product']) : '') ?>">Первая</a>
                <a class="button" href="?user_table_page=<?= $users_data['page'] - 1 ?>">Назад</a>
            <?php endif; ?>
            <span>Страница <?= $users_data['page'] ?> из <?= $users_data['total_pages'] ?></span>
            <?php if ($users_data['page'] < $users_data['total_pages']): ?>
                <a class="button" href="?user_table_page=<?= $users_data['page'] + 1 ?>">Вперёд</a>
                <a class="button" href="?user_table_page=<?= $users_data['total_pages'] ?>">Последняя</a>
            <?php endif; ?>
        </div>

        <form method="POST" action="admin_actions.php">
            <input type="hidden" name="table" value="users">
            <table>
                <tr>
                    <?php foreach ($users_cols as $c): 
                        $name = 'users_' . $c;
                        $val = isset($_GET[$name]) ? htmlspecialchars($_GET[$name]) : '';
                    ?>
                        <th><input type="text" name="<?= $name ?>" value="<?= $val ?>"></th>
                    <?php endforeach; ?>
                </tr>
            </table>
            <div class="pagination">
                <input type="submit" class="button" name="action" value="Найти">
                <input type="submit" class="button" name="action" value="Создать">
                <input type="submit" class="button" name="action" value="Изменить">
                <input type="submit" class="button" name="action" value="Удалить">
            </div>
        </form>

        <h2>Отзывы</h2>
        <?php if (!empty($reviews_data['rows'])): ?>
            <table>
                <tr>
                    <?php foreach ($reviews_cols as $c): ?>
                        <th><?= htmlspecialchars($c) ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($reviews_data['rows'] as $r): ?>
                    <tr>
                        <?php foreach ($reviews_cols as $c): ?>
                            <td><?= htmlspecialchars($r[$c]) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Нет данных для отображения.</p>
        <?php endif; ?>

        <div class="pagination">
            <?php if ($reviews_data['page'] > 1): ?>
                <a class="button" href="?review_table_page=1">Первая</a>
                <a class="button" href="?review_table_page=<?= $reviews_data['page'] - 1 ?>">Назад</a>
            <?php endif; ?>
            <span>Страница <?= $reviews_data['page'] ?> из <?= $reviews_data['total_pages'] ?></span>
            <?php if ($reviews_data['page'] < $reviews_data['total_pages']): ?>
                <a class="button" href="?review_table_page=<?= $reviews_data['page'] + 1 ?>">Вперёд</a>
                <a class="button" href="?review_table_page=<?= $reviews_data['total_pages'] ?>">Последняя</a>
            <?php endif; ?>
        </div>

        <form method="POST" action="admin_actions.php">
            <input type="hidden" name="table" value="reviews">
            <table>
                <tr>
                    <?php foreach ($reviews_cols as $c):
                        $name = 'reviews_' . $c;
                        $val = isset($_GET[$name]) ? htmlspecialchars($_GET[$name]) : '';
                    ?>
                        <th><input type="text" name="<?= $name ?>" value="<?= $val ?>"></th>
                    <?php endforeach; ?>
                </tr>
            </table>
            <div class="pagination">
                <input type="submit" class="button" name="action" value="Найти">
                <input type="submit" class="button" name="action" value="Создать">
                <input type="submit" class="button" name="action" value="Изменить">
                <input type="submit" class="button" name="action" value="Удалить">
            </div>
        </form>

        <h2>Аренды</h2>
        <?php if (!empty($rents_data['rows'])): ?>
            <table>
                <tr>
                    <?php foreach ($rents_cols as $c): ?>
                        <th><?= htmlspecialchars($c) ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($rents_data['rows'] as $r): ?>
                    <tr>
                        <?php foreach ($rents_cols as $c): ?>
                            <td><?= htmlspecialchars($r[$c]) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Нет данных для отображения.</p>
        <?php endif; ?>

        <div class="pagination">
            <?php if ($rents_data['page'] > 1): ?>
                <a class="button" href="?rent_table_page=1">Первая</a>
                <a class="button" href="?rent_table_page=<?= $rents_data['page'] - 1 ?>">Назад</a>
            <?php endif; ?>
            <span>Страница <?= $rents_data['page'] ?> из <?= $rents_data['total_pages'] ?></span>
            <?php if ($rents_data['page'] < $rents_data['total_pages']): ?>
                <a class="button" href="?rent_table_page=<?= $rents_data['page'] + 1 ?>">Вперёд</a>
                <a class="button" href="?rent_table_page=<?= $rents_data['total_pages'] ?>">Последняя</a>
            <?php endif; ?>
        </div>

        <form method="POST" action="admin_actions.php">
            <input type="hidden" name="table" value="rent">
            <table>
                <tr>
                    <?php foreach ($rents_cols as $c):
                        $name = 'rent_' . $c;
                        $val = isset($_GET[$name]) ? htmlspecialchars($_GET[$name]) : '';
                    ?>
                        <th><input type="text" name="<?= $name ?>" value="<?= $val ?>"></th>
                    <?php endforeach; ?>
                </tr>
            </table>
            <div class="pagination">
                <input type="submit" class="button" name="action" value="Найти">
                <input type="submit" class="button" name="action" value="Создать">
                <input type="submit" class="button" name="action" value="Изменить">
                <input type="submit" class="button" name="action" value="Удалить">
            </div>
        </form>

        <h2>Техника</h2>
        <?php if (!empty($products_data['rows'])): ?>
            <table>
                <tr>
                    <?php foreach ($products_cols as $c): ?>
                        <th><?= htmlspecialchars($c) ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($products_data['rows'] as $p): ?>
                    <tr>
                        <?php foreach ($products_cols as $c): ?>
                            <td><?= htmlspecialchars($p[$c]) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Нет данных для отображения.</p>
        <?php endif; ?>

        <div class="pagination">
            <?php if ($products_data['page'] > 1): ?>
                <a class="button" href="?product_table_page=1">Первая</a>
                <a class="button" href="?product_table_page=<?= $products_data['page'] - 1 ?>">Назад</a>
            <?php endif; ?>
            <span>Страница <?= $products_data['page'] ?> из <?= $products_data['total_pages'] ?></span>
            <?php if ($products_data['page'] < $products_data['total_pages']): ?>
                <a class="button" href="?product_table_page=<?= $products_data['page'] + 1 ?>">Вперёд</a>
                <a class="button" href="?product_table_page=<?= $products_data['total_pages'] ?>">Последняя</a>
            <?php endif; ?>
        </div>

        <form method="POST" action="admin_actions.php">
            <input type="hidden" name="table" value="products">
            <table>
                <tr>
                    <?php foreach ($products_cols as $c):
                        $name = 'products_' . $c;
                        $val = isset($_GET[$name]) ? htmlspecialchars($_GET[$name]) : '';
                    ?>
                        <th><input type="text" name="<?= $name ?>" value="<?= $val ?>"></th>
                    <?php endforeach; ?>
                </tr>
            </table>
            <div class="pagination">
                <input type="submit" class="button" name="action" value="Найти">
                <input type="submit" class="button" name="action" value="Создать">
                <input type="submit" class="button" name="action" value="Изменить">
                <input type="submit" class="button" name="action" value="Удалить">
            </div>
        </form>

    </div>
</div>

<?php
require_once "../header_and_footer/aside2.php";
require_once "../header_and_footer/footer.php";
?>