<?php
// Главная страница
require_once '../bootstrap.php';
require_once root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Главная");
HTML::insert("navbar");
?>

<div class="container p-3">
    <h1 class="m-3">Управление Техботом</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-link"></i> Ссылки на соц. сети Техбота</h5>
                    <div class="list-group list-group-flush">
                        <a href="https://vk.com/vpmt_bot" class="list-group-item list-group-item-action"><i class="fa-brands fa-vk"></i> ВКонтакте</a>
                        <a href="https://t.me/vpmt_texbot" class="list-group-item list-group-item-action"><i class="fa-brands fa-telegram"></i> Telegram</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-chart-simple"></i> Отчёты</h5>
                    <div class="list-group list-group-flush">
                        <a href="/reports/usercount.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-users"></i> Количество зарегистрированных пользователей</a>
                        <a href="/reports/functions-by-group.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-bars"></i> Использование функций Техбота (по группам)</a>
                        <a href="/reports/functions-by-fn.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-bars"></i> Использование функций Техбота (по видам функций)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-chalkboard-user"></i> Управление преподавателями</h5>
                    <div class="list-group list-group-flush">
                        <a href="/teachers/list.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-list"></i> Список</a>
                        <a href="/teachers/new.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-add"></i> Добавить</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-comment"></i> Обратная связь</h5>
                    <div class="list-group list-group-flush">
                        <a href="/feedback/list.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-list"></i> Список ошибок</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php HTML::end(); ?>