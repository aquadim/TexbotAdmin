<?php
// Редактирование преподавателей
require_once '../../bootstrap.php';
require_once root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Редактирование преподавателя");
HTML::insert("navbar");

// Преподаватель
use TexAdmin\Database;
use TexAdmin\Entities\Employee;

$em = Database::getEM();
$employee = $em->find(Employee::class, $_GET["id"]);
?>

<div class="container p-3">
    <h1 class="m-3">Редактирование преподавателя</h1>
    <?php HTML::teacherForm($employee); ?>
    <script src="/js/managedForm.js"></script>
</div>

<?php HTML::end(); ?>