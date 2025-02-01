<?php
// Просмотр обратной связи студентов
require_once '../../bootstrap.php';
require_once root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Обратная связь");
HTML::insert("navbar");

// Пагинация
use TexAdmin\Database;
use TexAdmin\Pagination;
use TexAdmin\Entities\ErrorReport;

$dql = "SELECT er FROM ".ErrorReport::class." er";
$per_page = 30;

$em = Database::getEM();
$items = Pagination::getItems($dql, $per_page);
$total = count($items);
?>

<div id="list" class="container p-3">
    <h1 class="m-3">Обратная связь</h1>
    <p>Эти данные предоставили студенты через интерфейс Техбота</p>

    <div class="row row-cols-1 g-4">
        <?php foreach ($items as $report) { ?>
            <div class="col" id="r<?= $report->getId() ?>">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <strong>Описание</strong>: <?= htmlspecialchars($report->getDescription()) ?>
                        </p>
                        <p>
                            <strong>Как воспроизвести</strong>: <?= htmlspecialchars($report->getStepsToReproduce()) ?>
                        </p>
                        <p>
                            <strong>Дата добавления</strong>: <?= $report->getCreatedAt()->format("Y-m-d") ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php HTML::pagination(Pagination::getPageNumber(), $total, $per_page, "feedback") ?>
</div>

<?php HTML::end(); ?>