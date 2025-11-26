<?php
require_once "../code/db.php";
$id_product = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$stmt = $connect->prepare("SELECT name_product, photo, price, weight, available, id_type, bucket_volume, digging_depth, engine_power, dimensions, speed FROM Products WHERE id_product = ?");
$stmt->bind_param("i", $id_product);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    header("Location: catalog.php");
    exit;
}
$stmt->bind_result($name_product, $photo, $price, $weight, $available, $id_type, $bucket_volume, $digging_depth, $engine_power, $dimensions, $spead);
$stmt->fetch();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION["id_user"])) {
        header("Location: ../main/register.php");
        exit;
    }
    if ($available > 0) {
        $user_id = $_SESSION["id_user"];
        $final_price = 0;
        $date = $_POST['rental_date'];
        $time = $_POST['duration'];
        $duration_hours = intval($_POST['duration']);
        $pricePerHour = $price;
        $discount = 0;
        if ($duration_hours >= 3 && $duration_hours < 5) {
            $discount = 5;
        } elseif ($duration_hours >= 5 && $duration_hours < 7) {
            $discount = 10;
        } elseif ($duration_hours >= 7 && $duration_hours < 9) {
            $discount = 15;
        } elseif ($duration_hours >= 9) {
            $discount = 20;
        }
        $totalCost = $pricePerHour * $duration_hours;
        $final_price = $totalCost - ($totalCost * $discount / 100);
        $installmentStmt = $connect->prepare("INSERT INTO Rent (id_user, id_product, price, date, time, id_status) VALUES (?, ?, ?, ?, ?, 1)");
        $installmentStmt->bind_param("iisss", $user_id, $id_product, $final_price, $date, $duration_hours);
        $installmentStmt->execute();
        header("Location: ../main/lk.php");
        exit;
    } else {
        header("Location: ../main/catalog.php");
        exit;
    }
}
require_once "../header_and_footer/header.php";
require_once "../header_and_footer/aside1.php";
?>
<div class="site_content">
    <div class="container">
        <div class="container_flex">
            <img src="<?= htmlspecialchars($photo) ?>" alt="<?= htmlspecialchars($name_product) ?>">
            <div>
                <form method="POST" action="">
                    <h1><?= htmlspecialchars($name_product) ?></h1>
                    <?php if ($weight != 0): ?>
                        <p>Масса: <?= htmlspecialchars($weight) ?> кг</p>
                    <?php endif; ?>
                    <?php if ($bucket_volume != 0): ?>
                        <p>Объем ковша: <?= htmlspecialchars($bucket_volume) ?> м</p>
                    <?php endif; ?>
                    <?php if ($digging_depth != 0): ?>
                        <p>Глубина копания: <?= htmlspecialchars($digging_depth) ?> м</p>
                    <?php endif; ?>
                    <?php if ($engine_power != 0): ?>
                        <p>Мощность двигателя: <?= htmlspecialchars($engine_power) ?> л.с</p>
                    <?php endif; ?>
                    <?php if ($dimensions != 0): ?>
                        <p>Габариты: <?= htmlspecialchars($dimensions) ?> м</p>
                    <?php endif; ?>
                    <?php if ($spead != 0): ?>
                        <p>Скорость передвижения: <?= htmlspecialchars($spead) ?> км/ч</p>
                    <?php endif; ?>
                    <p>Стоимость аренды зависит от цены и длительности аренды, но также есть скидка, зависящая от
                        длительности</p>
                    <p>от 3 до 4 часов скидка 5%</p>
                    <p>от 5 до 6 часов скидка 10%</p>
                    <p>от 7 до 8 часов скидка 15%</p>
                    <p>от 9 часов и более скидка 20%</p>
                    <input type="number" id="duration" name="duration"
                        placeholder="Укажите длительность аренды (в часах)" required>
                    <input type="date" name="rental_date" required>
                    <p id="original-price"><?= htmlspecialchars($price) ?> ₽ за 1 час</p>
                    <p>Свободно для аренды: <?= htmlspecialchars($available) ?></p>
                    <h2>Итоговая стоимость: <span id="final-price"><?= number_format($price, 2, '.', '') ?></span> ₽
                    </h2>
                    <p id="discount-info"></p>
                    <input type="submit" value="Арендовать">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const pricePerHour = <?= $price ?>;
    function updatePrice() {
        const durationInput = document.getElementById("duration").value;
        const duration = parseInt(durationInput) || 0;
        let discount = 0;
        if (duration >= 3 && duration < 5) {
            discount = 5;
        } else if (duration >= 5 && duration < 7) {
            discount = 10;
        } else if (duration >= 7 && duration < 9) {
            discount = 15;
        } else if (duration >= 9) {
            discount = 20;
        }
        const totalCostWithoutDiscount = pricePerHour * duration;
        const finalPrice = totalCostWithoutDiscount - (totalCostWithoutDiscount * discount / 100);
        document.getElementById("final-price").textContent = finalPrice.toFixed(2);
        document.getElementById("discount-info").textContent = discount > 0 ? "Вам положена скидка " + discount + "% в зависимости от количества часов аренды." : "";
    }
    document.getElementById("duration").addEventListener("input", updatePrice);
</script>
<?php
require_once "../header_and_footer/aside2.php";
require_once "../header_and_footer/footer.php";
?>