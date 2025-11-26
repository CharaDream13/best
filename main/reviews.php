<?php
require_once '../code/db.php';
require_once '../code/db.php';
$id_rent_source = isset($_POST['id_rent']) ? INPUT_POST : INPUT_GET;
$received_id_rent = filter_input($id_rent_source, 'id_rent', FILTER_SANITIZE_NUMBER_INT);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $current_user_id = $_SESSION['id_user'];
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    if ($rating === false || $rating < 1 || $rating > 5) {
    } else {
        $show_login = isset($_POST['login']) ? true : false;
        $show_first_name = isset($_POST['first_name']) ? true : false;
        $show_last_name = isset($_POST['last_name']) ? true : false;
        $show_patronymic = isset($_POST['patronymic']) ? true : false;
        if ($show_login + $show_first_name + $show_last_name === false) {
        } else {
            $comment = htmlspecialchars($_POST['text-input']);
            $date = date('Y-m-d H:i:s');
            $id_moder_status = 1;
            $insert_sql = "INSERT INTO `Reviews` (`id_user`, `rating`, `comment`, `date`, `id_moder_status`, `show_first_name`, `show_last_name`, `show_patronymic`, `show_login`, `id_rent`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $connect->prepare($insert_sql);
            if ($insert_stmt) {
                $insert_stmt->bind_param("iisssiiiii",$current_user_id,$rating,$comment,$date,$id_moder_status,$show_first_name,$show_last_name,$show_patronymic,$show_login,$received_id_rent
                );
                $insert_stmt->execute();
                $insert_stmt->close();
            }
        }
    }
}
if (!isset($_SESSION['id_user']) || empty($received_id_rent)) {
    header('Location: about_us.php');
    exit();
}
$current_user_id = $_SESSION['id_user'];
$canAccess = false;
$hasExistingReview = false;
$review_check_sql = "SELECT 1 FROM Reviews WHERE id_rent = ? LIMIT 1";
$review_check_stmt = $connect->prepare($review_check_sql);
$review_check_stmt->bind_param("i", $received_id_rent);
$review_check_stmt->execute();
$review_check_stmt->store_result();
if ($review_check_stmt->num_rows > 0) {
    $hasExistingReview = true;
}
$review_check_stmt->close();
$rent_check_sql = "SELECT 1 FROM Rent WHERE id_rent = ? AND id_user = ? AND id_status = 2 LIMIT 1";
$rent_check_stmt = $connect->prepare($rent_check_sql);
$rent_check_stmt->bind_param("ii", $received_id_rent, $current_user_id);
$rent_check_stmt->execute();
$rent_check_stmt->store_result();
if ($rent_check_stmt->num_rows > 0) {
    $canAccess = true;
}
$rent_check_stmt->close();
if (!$canAccess || $hasExistingReview) {
    header('Location: about_us.php');
    exit();
}
require_once '../header_and_footer/header.php';
require_once '../header_and_footer/aside1.php';
?>
<div class="site_content">
    <div class="container">
        <h2>Хотите оставить отзыв?</h2>

        <div class="container_flex">
            <div>
                <form action="" method="POST">
                    <input type="hidden" name="id_rent" value="<?= htmlspecialchars($received_id_rent) ?>">

                    <p>Напишите отзыв, укажите что хотите указать, и поставте оценку</p>
                    <div class="container_reg">
                        <label>Логин?</label>
                        <input type="checkbox" name="login" id="login">
                        <label>ФИО?</label>
                        <input type="checkbox" name="first_name" id="first_name">
                        <input type="checkbox" name="last_name" id="last_name">
                        <input type="checkbox" name="patronymic" id="patronymic">
                    </div>
                    <div class="container_reg">
                        <label>Оценка? (обязательно)</label>
                        <div class="container_flex">
                            <input type="radio" name="rating" id="rating1" value="1" required>
                            <input type="radio" name="rating" id="rating2" value="2">
                            <input type="radio" name="rating" id="rating3" value="3">
                            <input type="radio" name="rating" id="rating4" value="4">
                            <input type="radio" name="rating" id="rating5" value="5">
                        </div>
                    </div>
                    <textarea name="text-input" rows="4" cols="50"></textarea>
                    <input type="submit" name="submit_review" value="Отправить отзыв">
                </form>
            </div>
            <img src="../media/koles_2.png" alt="Изображение">
        </div>
    </div>
</div>
<?php
require_once '../header_and_footer/aside2.php';
require_once '../header_and_footer/footer.php';
?>