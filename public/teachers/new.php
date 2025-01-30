<?php
// Создание преподавателей
require_once '../../bootstrap.php';
require_once root_dir."/auth.php";

use TexAdmin\HTML;
HTML::start("Создание преподавателя");
HTML::insert("navbar");
?>

<div class="container p-3">
    <h1 class="m-3">Создание преподавателя</h1>
    <?php HTML::teacherForm(null); ?>
    <script src="/js/managedForm.js"></script>
</div>

<?php HTML::end(); ?>