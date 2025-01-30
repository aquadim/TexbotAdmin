<?php
if ($view_data["e"] != null) {
    $surname = $view_data["e"]->getSurname();
    $name = $view_data["e"]->getName();
    $patronymic = $view_data["e"]->getPatronymic();
    $id = $view_data["e"]->getId();
    $action = "/api/teachers/update.php";
} else {
    $surname = "";
    $name = "";
    $patronymic = "";
    $id = 0;
    $action = "/api/teachers/new.php";
}
?>
<form id="form" action="<?= $action ?>" method="POST">
    <div class="mb-3">
        <label for="surname" class="form-label">Фамилия</label>
        <input type="text" class="form-control" id="surname" name="surname" value="<?= $surname ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
    </div>
    <div class="mb-3">
        <label for="patronymic" class="form-label">Отчество</label>
        <input type="text" class="form-control" id="patronymic" name="patronymic" value="<?= $patronymic ?>">
    </div>

    <input type="hidden" name="id" value="<?= $id ?>"/>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="/teachers/list.php" class="btn btn-secondary">Отменить</a>
</form>