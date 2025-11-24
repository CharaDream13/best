<?php
require_once "../code/db.php";
if (!isset($_SESSION)) { session_start(); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin.php");
    exit;
}

$table = isset($_POST['table']) ? $_POST['table'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$allowed = array('users','reviews','rent','products');

if (!in_array($table, $allowed)) {
    header("Location: admin.php");
    exit;
}

$cols_map = array(
    'users' => array('id_user','login','email','phone','first_name','last_name','patronymic','id_rule'),
    'reviews' => array('id_review','id_user','id_rent','rating','comment','date','show_first_name','show_last_name','show_patronymic','show_login','id_moder_status'),
    'rent' => array('id_rent','id_user','id_product','price','date','time','id_status'),
    'products' => array('id_product','name_product','photo','price','weight','bucket_volume','digging_depth','engine_power','dimensions','speed','available','id_type')
);

$cols = $cols_map[$table];
$prefix = $table . '_';
$data = array();

foreach ($cols as $c) {
    $key = $prefix . $c;
    $data[$c] = isset($_POST[$key]) && $_POST[$key] !== '' ? $_POST[$key] : null;
}

if ($action === 'Найти') {
    $params = array();
    foreach ($data as $col => $val) {
        if ($val !== null) {
            $params[$prefix . $col] = $val;
        }
    }
    $qs = http_build_query($params);
    header("Location: admin.php" . ($qs != '' ? '?' . $qs : ''));
    exit;
}

if ($action === 'Создать') {
    $insertCols = array();
    $insertVals = array();
    foreach ($data as $col => $val) {
        if ($val !== null) {
            $insertCols[] = "`" . $col . "`";
            $insertVals[] = "'" . $connect->real_escape_string($val) . "'";
        }
    }
    if (count($insertCols) > 0) {
        $sql = "INSERT INTO `" . $connect->real_escape_string($table) . "` (" . implode(', ', $insertCols) . ") VALUES (" . implode(', ', $insertVals) . ")";
        $connect->query($sql);
    }
    header("Location: admin.php");
    exit;
}

if ($action === 'Изменить') {
    $idCol = $cols[0];
    if (!isset($data[$idCol]) || $data[$idCol] === null || $data[$idCol] === '') {
        header("Location: admin.php");
        exit;
    }
    $idVal = $connect->real_escape_string($data[$idCol]);
    $setParts = array();
    foreach ($data as $col => $val) {
        if ($col === $idCol) continue;
        if ($val !== null) {
            $setParts[] = "`$col` = '" . $connect->real_escape_string($val) . "'";
        }
    }
    if (count($setParts) > 0) {
        $sql = "UPDATE `" . $connect->real_escape_string($table) . "` SET " . implode(', ', $setParts) . " WHERE `$idCol` = '$idVal' LIMIT 1";
        $connect->query($sql);
    }
    header("Location: admin.php");
    exit;
}

if ($action === 'Удалить') {
    $conds = array();
    foreach ($data as $col => $val) {
        if ($val !== null) {
            $conds[] = "`$col` = '" . $connect->real_escape_string($val) . "'";
        }
    }
    if (count($conds) == 0) {
        header("Location: admin.php");
        exit;
    }
    $sql = "DELETE FROM `" . $connect->real_escape_string($table) . "` WHERE " . implode(' AND ', $conds) . " LIMIT 1";
    $connect->query($sql);
    header("Location: admin.php");
    exit;
}

header("Location: admin.php");
exit;
?>