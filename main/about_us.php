<?php
    require_once "../code/db.php";
    require_once "../header_and_footer/header.php";
    require_once "../header_and_footer/aside1.php";
    $stmt = $connect->prepare("
    SELECT 
        r.comment, r.date, r.rating, r.show_first_name, r.show_last_name, r.show_patronymic, r.id_user, r.show_login, 
        u.first_name, u.last_name, u.patronymic, u.login
    FROM Reviews r
    LEFT JOIN Users u ON r.id_user = u.id_user
    WHERE r.id_moder_status = 2
    ORDER BY RAND()
    LIMIT 10
");

$stmt->execute();
$connect->set_charset('utf8');
$stmt->bind_result(
    $comment,
    $date,
    $rating,
    $show_first_name,
    $show_last_name,
    $show_patronymic,
    $id_user,
    $show_login,
    $first_name,
    $last_name,
    $patronymic,
    $login
);

$reviews = array();

while ($stmt->fetch()) {
    $reviews[] = array(
        'comment' => $comment,
        'date' => $date,
        'rating' => $rating,
        'show_first_name' => $show_first_name,
        'show_last_name' => $show_last_name,
        'show_patronymic' => $show_patronymic,
        'show_login' => $show_login,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'patronymic' => $patronymic,
        'login' => $login
    );
}
?>
        <div class="logo_block">
            <img src="../media/baner.png" class="img_block">
            <h1>СпецТехАренда</h1>
        </div>
        <div class="site_content">
            <div class="container">
                <h2>Наш девиз</h2>
                <div class="container_flex">
                    <img src="../media/gusyanka.png">
                    <div>
                        <p>созидание и мастерство на всех этапах строительных и монтажных работ,</p>
                        <p>внимание к деталям и особым пожеланиям заказчиков. Умение совмещать несовместимое,</p>
                        <p>находить нестандартные и эффективные методы решения текущих задач,</p>
                        <p>предлагать лучшие варианты реализации проектов в заданных условиях – умение,</p>
                        <p>которое дано не каждому. В каждом штрихе, рабочем моменте и конечном результате</p>
                        <p>прослеживается качество, скрупулезность, оправданная экономия</p>
                        <p>и эстетика строительного творчества с большой буквы.</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Преймущества</h2>
                <div class="container_grid">
                    <div>
                        <img src="../media/prem/ben-1.svg">
                        <p>
                            За клиентом закрепляется персональный менеджер
                            который оперативно ответит на вопросы по эксплуатации техники и поможет решить сложности.
                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-2.svg">
                        <p>
                            Работаем ежедневно без выходных
                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-3.svg">
                        <p>
                            Работаем официально по лицензии, заключаем договор, можем работать в рамках 44-ФЗ и 223-ФЗ.
                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-4.svg">
                        <p>
                            Предоставляем исправную, проверенную технику которая регулярно проходит техосмотр. В случае 
                            поломки оперативно заменим экскаватор-погрузчик на аналогичную по характеристикам модель.
                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-5.svg">
                        <p>
                            Оказываем услугу аренды спецтехники по Москве и Московской области.

                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-6.svg">
                        <p>
                            Срок аренды может быть любой от половины рабочего дня до целого сезона
                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-7.svg">
                        <p>
                            Цена аренды гибкая зависит от задач, модели техники, объёма работ и местонахождения объекта.
                        </p>
                    </div>
                    <div>
                        <img src="../media/prem/ben-8.svg">
                        <p>
                            Готовы предоставить смежные услуги например, вывоз мусора, вывоз грунта, уборка снега или аренда самосвала.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Описание</h2>
                <div class="container_flex">
                    <div>
                        <p>Мы молодая развивающаяся компания на рынке аренды строительной и специализированной техники.</p>
                        <p>За короткий срок мы достигли определенных высот на рынке став надежными партнерами для наших клиентов.</p>
                        <p>Лучше любых слов о нас скажут факты и цифры:</p>
                        <p>1 Наша техника задействована в строительстве «Северный поток-2».Этот строящийся магистральный соединяющийся газопровод из России в Германию. Его протяженность составляет более 1200 км;</p>
                        <p>2 Участвуем в реконструкции автомобильной дороги федерального значения М4-Дон. Протяжённость автодороги составляет 1543 км;</p>
                        <p>3 Наши специалисты участвуют в строительстве и реконструкции газораспределительных станций на территории Ленинградской области;</p>
                        <p>4 Обеспечиваем техникой строящиеся жилищные комплексы на территории всего Северо-Западного Федерального района,</p>
                        <p>а также Московской области. Ответственно смотрим в завтрашний день!</p>
                    </div>
                    <img src="../media/koles_2.png">
                </div>
            </div>
            <div class="container">
                <h2>Отзывы</h2>
                <div class="reviews-slider-container">
    <div class="reviews-slider">
        <?php
        $randomReviews = array_rand($reviews, 5);
        if (!is_array($randomReviews)) {
            $randomReviews = array($randomReviews);
        }
        foreach ($randomReviews as $index) {
            $review = $reviews[$index];
        ?>
            <div class="slide">
                <p>
                    <?php
                        $nameParts = array();
                        if ($review['show_first_name']) {
                            $nameParts[] = htmlspecialchars($review['first_name']);
                        }
                        if ($review['show_last_name']) {
                            $nameParts[] = htmlspecialchars($review['last_name']);
                        }
                        if ($review['show_patronymic']) {
                            $nameParts[] = htmlspecialchars($review['patronymic']);
                        }
                        if ($review['show_login']) {
                            $nameParts[] = htmlspecialchars($review['login']);
                        }
                        echo '<strong>' . implode(' ', $nameParts) . '</strong>';
                    ?>
                </p>
                <p><?php echo htmlspecialchars($review['comment']); ?></p>
                <p><em>Дата: <?php echo htmlspecialchars($review['date']); ?></em></p>
                <p>Рейтинг:
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $review['rating']) {
                            echo '<span class="star active">★</span>';
                        } else {
                            echo '<span class="star">☆</span>';
                        }
                    }
                    ?>
                </p>
            </div>
        <?php } ?>
    </div>
    <div class="pagination">
    <button class="slider-prev button">Назад</button>
    <button class="slider-next button">Вперед</button>
    </div>
</div>
            </div>
        </div>
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.reviews-slider .slide');
        const prevBtn = document.querySelector('.slider-prev');
        const nextBtn = document.querySelector('.slider-next');
        let currentSlide = 0;
        showSlide(currentSlide);
        nextBtn.addEventListener('click', function() {
            currentSlide++;
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        });
        prevBtn.addEventListener('click', function() {
            currentSlide--;
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }
            showSlide(currentSlide);
        });
        function showSlide(index) {
            slides.forEach(function(slide, i) {
                slide.classList.toggle('active', i === index);
            });
        }
    });
</script>
<?php
    require_once "../header_and_footer/aside2.php";
    require_once "../header_and_footer/footer.php";
?>