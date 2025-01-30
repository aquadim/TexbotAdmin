<?php
// Скрипт проверяет авторизацию в API
if (!isset($_SESSION["allowed"]) || !$_SESSION["allowed"]) {
    http_response_code(401);
    exit();
}