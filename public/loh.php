<?php
// Главная страница
require_once '../bootstrap.php';
require_once root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Главная");
HTML::insert("navbar");
?>

<div class="container p-3">
    <h1 class="m-3">Лох!</h1>
    <h1 class="m-3">¯\_(ツ)_/¯</h1>
    <p class="m-3">Эта страница ещё не сделана лол</p>
</div>

<?php HTML::end(); ?>