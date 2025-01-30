<?php
// Скрипт проверки авторизации веб-интерфейса
if (!isset($_SESSION["allowed"]) || $_SESSION['allowed'] == false) {
    header("Location: /login.php");
    exit();
}