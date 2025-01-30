<?php
// Страница отчёта количества зарегистрированных пользователей
require_once '../../bootstrap.php';
require root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Зарегистрированные пользователи");
HTML::insert("navbar");
?>

<div class="container">
    <h1>Зарегистрированные пользователи</h1>
    <p>Количество студентов, которые зарегистрировались в Техботе в разрезе групп.</p>
    <div id="tableArea"></div>
</div>

<script src="js/usercount.js"></script>
<?php HTML::end(); ?>