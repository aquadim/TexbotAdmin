<?php
// Страница авторизации
require_once '../bootstrap.php';

use TexAdmin\HTML;
HTML::start("Авторизация");
HTML::insert("navbar");

$display_error = false;

// Если метод - POST, произошла попытка авторизации, проверяем
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["password"]) &&
        hash('sha256', $_POST["password"]) === $_ENV["admin_password"]
    ) {
        // Успешная авторизация
        $_SESSION['allowed'] = true;
        header("Location: /index.php");
        exit();
    } else {
        // Неуспешная авторизация
        $display_error = true;
    }
}
?>

<div class="container p-3">
    <h1>Авторизация | Техбот</h1>

    <?php if ($display_error) { ?>
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Авторизация не выполнена</div>
            <div class="card-body">
                <p class="card-text">
                    Пароль не совпадает <?= hash('sha256', $_POST["password"]) ?>
                </p>
            </div>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Авторизация</button>
    </form>
</div>

<?php HTML::end(); ?>