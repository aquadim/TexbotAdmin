<?php
// Просмотр всех преподавателей
require_once '../../bootstrap.php';
require_once root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Список преподавателей");
HTML::insert("navbar");

// Пагинация
use TexAdmin\Database;
use TexAdmin\Pagination;
use TexAdmin\Entities\Employee;

$dql = "SELECT t FROM ".Employee::class." t";
$per_page = 30;

$em = Database::getEM();
$items = Pagination::getItems($dql, $per_page);
$total = count($items);
?>

<div class="container p-3">
    <h1 class="m-3">Список преподавателей</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php foreach ($items as $teacher) { ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <?= $teacher->getSurname() ?> <?= $teacher->getName() ?> <?= $teacher->getPatronymic() ?>
                        </p>
                        <a href="#" class="btn btn-secondary">Редактировать</a>
                        <a href="#" class="btn btn-danger">Удалить</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php HTML::pagination(Pagination::getPageNumber(), $total, $per_page, "teachers") ?>
</div>

<?php HTML::end(); ?>