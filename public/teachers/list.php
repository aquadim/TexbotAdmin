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

$dql = "SELECT t FROM ".Employee::class." t WHERE t.hidden=0";
$per_page = 30;

$em = Database::getEM();
$items = Pagination::getItems($dql, $per_page);
$total = count($items);
?>

<div id="list" class="container p-3">
    <h1 class="m-3">Список преподавателей</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
        <?php foreach ($items as $teacher) { ?>
            <div class="col" id="t<?= $teacher->getId() ?>">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <?= $teacher->getSurname() ?> <?= $teacher->getName() ?> <?= $teacher->getPatronymic() ?>
                        </p>
                        <a href="/teachers/edit.php?id=<?= $teacher->getId() ?>" class="btn btn-secondary">Редактировать</a>
                        <button data-id="<?= $teacher->getId() ?>" class="btn btn-danger deleteBtn">Удалить</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php HTML::insert("confirm-delete-modal"); ?>
    <?php HTML::pagination(Pagination::getPageNumber(), $total, $per_page, "teachers") ?>
</div>

<script type="module">
import { bind } from "/js/deletion.js"
bind(
    "list",
    "deleteBtn",
    "confirmModal",
    "confirmDelete",
    "t",
    function(formData) {
        fetch("/api/teachers/remove.php", {
            body: new URLSearchParams(formData),
            method: "post"
        });
    }
);
</script>

<?php HTML::end(); ?>